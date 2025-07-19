<?php

require_once __DIR__ . '/../vendor/autoload.php';

function prompt(string $message): string {
    echo $message;
    return trim(fgets(STDIN));
}

function writeEnvIfNotExists(array $config): void {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['dbname']};port={$config['port']}";
        $env = <<<ENV
DB_USER={$config['user']}
DB_PASS={$config['pass']}
DSN=$dsn
URL=http://localhost:8000/
ENV;
        file_put_contents($envPath, $env);
        echo ".env généré avec succès à la racine du projet.\n";
    } else {
        echo "Le fichier .env existe déjà, aucune modification.\n";
    }
}

$driver = strtolower(prompt("Quel SGBD utiliser ? (mysql / pgsql) : "));
$host = prompt("Hôte (default: 127.0.0.1) : ") ?: "127.0.0.1";
$port = prompt("Port (default: 3306 ou 5432) : ") ?: ($driver === 'pgsql' ? "5432" : "3306");
$user = prompt("Utilisateur (default: root) : ") ?: "root";
$pass = prompt("Mot de passe : ");
$dbName = prompt("Nom de la base à créer : ");

try {
    $dsn = "$driver:host=$host;port=$port";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($driver === 'mysql') {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Base MySQL `$dbName` créée avec succès.\n";
        $pdo->exec("USE `$dbName`");
    } elseif ($driver === 'pgsql') {
        $check = $pdo->query("SELECT 1 FROM pg_database WHERE datname = '$dbName'")->fetch();
        if (!$check) {
            $pdo->exec("CREATE DATABASE \"$dbName\"");
            echo "Base PostgreSQL `$dbName` créée.\nRelancez la migration pour créer les tables.\n";
            writeEnvIfNotExists([
                'driver' => $driver,
                'host' => $host,
                'port' => $port,
                'user' => $user,
                'pass' => $pass,
                'dbname' => $dbName
            ]);
            exit;
        } else {
            echo "ℹ Base PostgreSQL `$dbName` déjà existante.\n";
        }
    }

    $dsn = "$driver:host=$host;port=$port;dbname=$dbName";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($driver === 'mysql') {
        $tables = [
            "CREATE TABLE IF NOT EXISTS profil (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nomprofil VARCHAR(100) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS utilisateurs (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                login VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                numerocarteidentite VARCHAR(50) UNIQUE,
                photorecto TEXT,
                photoverso TEXT,
                adresse TEXT
            );",
            "CREATE TABLE IF NOT EXISTS comptes (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                datecreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                solde DECIMAL(15, 2) DEFAULT 0.00,
                telephone VARCHAR(20) NOT NULL UNIQUE,
                typecompte ENUM('principal', 'secondaire') NOT NULL,
                utilisateurid INT UNSIGNED NOT NULL,
                FOREIGN KEY (utilisateurid) REFERENCES utilisateurs(id)
            );",
            "CREATE TABLE IF NOT EXISTS transactions (
                id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                typetransaction ENUM('depot', 'retrait', 'paiement') NOT NULL,
                montant DECIMAL(15, 2) NOT NULL,
                compteid INT UNSIGNED NOT NULL,
                FOREIGN KEY (compteid) REFERENCES comptes(id)
            );"
        ];
    } else {
        $pdo->exec("DO $$
        BEGIN
            IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'transaction_type') THEN
                CREATE TYPE transaction_type AS ENUM ('depot', 'retrait', 'transfert');
            END IF;
        END$$;");

        $tables = [
            "CREATE TABLE IF NOT EXISTS profil (
                id SERIAL PRIMARY KEY,
                nomprofil VARCHAR(100) NOT NULL
            );",
            "CREATE TABLE IF NOT EXISTS utilisateurs (
                id SERIAL PRIMARY KEY,
                nom VARCHAR(100) NOT NULL,
                prenom VARCHAR(100) NOT NULL,
                login VARCHAR(50) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                numerocarteidentite VARCHAR(50) UNIQUE,
                photorecto TEXT,
                photoverso TEXT,
                adresse TEXT
            );",
            "CREATE TABLE IF NOT EXISTS comptes (
                id SERIAL PRIMARY KEY,
                datecreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                solde DECIMAL(15, 2) DEFAULT 0.00,
                telephone VARCHAR(20) NOT NULL UNIQUE,
                typecompte VARCHAR(20) NOT NULL CHECK (typecompte IN ('principal', 'secondaire')),
                utilisateurid INTEGER NOT NULL,
                FOREIGN KEY (utilisateurid) REFERENCES utilisateurs(id)
            );",
            "CREATE TABLE IF NOT EXISTS transactions (
                id SERIAL PRIMARY KEY,
                date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                typetransaction VARCHAR(20) NOT NULL CHECK (typetransaction IN ('depot', 'retrait', 'paiement')),
                montant DECIMAL(15, 2) NOT NULL,
                compteid INTEGER NOT NULL,
                FOREIGN KEY (compteid) REFERENCES comptes(id)
            );"
        ];
    }

    foreach ($tables as $sql) {
        $pdo->exec($sql);
    }

    echo "Toutes les tables ont été créées avec succès dans `$dbName`.\n";
    writeEnvIfNotExists([
        'driver' => $driver,
        'host' => $host,
        'port' => $port,
        'user' => $user,
        'pass' => $pass,
        'dbname' => $dbName
    ]);

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}