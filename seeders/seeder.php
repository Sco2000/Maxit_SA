<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();


try {
    $pdo = new PDO($_ENV['DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données\n";
} catch (PDOException $e) {
    die(" Connexion échouée : " . $e->getMessage());
}

try {
    $pdo->beginTransaction();

    // 1. Profils
    $profils = ['Administrateur', 'Vendeur'];
    $stmtProfil = $pdo->prepare("INSERT INTO profil (nomprofil) VALUES (?)");
    foreach ($profils as $profil) {
        $stmtProfil->execute([$profil]);
    }
    echo "✅ Profils insérés\n";

    // 2. Utilisateurs
    $utilisateurs = [
        ['Fallou', 'Ndiaye', 'admin@maxitsa.sn', 'passer123', 'CNI001', 'recto1.png', 'verso1.png', 'Dakar Liberté 6'],
        ['Ousmane', 'Marra', 'ousmane@maxitsa.sn', 'passer123', 'CNI002', 'recto2.png', 'verso2.png', 'Dakar Médina'],
        ['Astou', 'Mbow', 'astou@maxitsa.sn', 'passer123', 'CNI003', 'recto3.png', 'verso3.png', 'Rufisque'],
        ['Thierno', 'Sagnane', 'thierno@maxitsa.sn', 'passer123', 'CNI004', 'recto4.png', 'verso4.png', 'Ziguinchor'],
        ['Bamba', 'Thiam', 'bamba@maxitsa.sn','passer123', 'CNI005', 'recto5.png', 'verso5.png', 'Kaolack'],
        ['Faby', 'Sow', 'faby@maxitsa.sn', 'passer123', 'CNI006', 'recto6.png', 'verso6.png', 'Touba']
    ];
    $stmtUser = $pdo->prepare("INSERT INTO utilisateurs (nom, prenom, login, password, numerocarteidentite, photorecto, photoverso, adresse) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $userIds = [];
    foreach ($utilisateurs as $u) {
        $stmtUser->execute($u);
        $userIds[] = $pdo->lastInsertId();
    }
    echo "✅ Utilisateurs insérés\n";

    // 3. Comptes
    $comptes = [
        ['770000001', 'principal', 150000, $userIds[0]],
        ['770000002', 'principal', 120000, $userIds[1]],
        ['770000003', 'principal', 20000, $userIds[2]],
        ['770000004', 'principal', 80000, $userIds[3]],
        ['770000005', 'principal', 30000, $userIds[4]],
        ['770000006', 'principal', 100000, $userIds[5]],
    ];
    $stmtCompte = $pdo->prepare("INSERT INTO comptes (telephone, typecompte, solde, utilisateurid) VALUES (?, ?, ?, ?)");
    $compteIds = [];
    foreach ($comptes as $compte) {
        $stmtCompte->execute($compte);
        $compteIds[] = $pdo->lastInsertId();
    }
    echo "✅ Comptes insérés\n";

    // 4. Transactions
    $transactions = [
        ['2025-07-18 12:00:00', 'paiement', 10000, $compteIds[0]],
        ['2025-07-18 14:00:00', 'retrait', 5000, $compteIds[1]],
        ['2025-07-18 15:00:00', 'depot', 20000, $compteIds[2]],
        ['2025-07-18 16:00:00', 'paiement', 15000, $compteIds[3]],
        ['2025-07-18 17:00:00', 'retrait', 10000, $compteIds[4]],
    ];
    $stmtTrx = $pdo->prepare("INSERT INTO transactions (date, typetransaction, montant, compteid) VALUES (?, ?, ?, ?)");
    foreach ($transactions as $trx) {
        $stmtTrx->execute($trx);
    }
    echo "✅ Transactions insérées\n";

    $pdo->commit();
    echo "🎉 Données seedées avec succès !\n";

}catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}