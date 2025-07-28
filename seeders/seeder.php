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
    $utilisateurs = [['id'=>1,'nom'=>'Marra','prenom'=>'Ousmane','login'=>'ousmane','password'=>'ousmane00','numerocarteidentite'=>'1870200000502','photorecto'=>'hello.jpg','photoverso'=>'hello.jpg','adresse'=>'Rufique','profilid'=>1]];

    $stmtUser = $pdo->prepare("INSERT INTO utilisateurs (id, nom, prenom, login, password, numerocarteidentite, photorecto, photoverso, adresse, profilid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $userIds = [];
    foreach ($utilisateurs as $u) {
        $stmtUser->execute(
        [$u['id'],
        $u['nom'],
        $u['prenom'],
        $u['login'],
        $u['password'],
        $u['numerocarteidentite'],
        $u['photorecto'],
        $u['photoverso'],
        $u['adresse'],
        $u['profilid']]);
    }
    echo "✅ Utilisateurs insérés\n";

    // 3. Comptes
    $comptes = [
        ['id' => 1,'datecreation' => '2025-07-17 21:37:39.001863','solde' => 10000.00,'telephone' => '774368884','typecompte' => 'principal','utilisateurid' => 1],
        ['id' => 2,'datecreation' => '2025-07-17 21:49:51.298761','solde' => 10000.00,'telephone' => '775071912','typecompte' => 'secondaire','utilisateurid' => 1],
        ['id' => 3,'datecreation' => '2025-07-17 21:51:52.669186','solde' => 10000.00,'telephone' => '775583233','typecompte' => 'secondaire','utilisateurid' => 1],
        ['id' => 4,'datecreation' => '2025-07-17 22:25:40.871562','solde' => 10000.00,'telephone' => '778801947','typecompte' => 'secondaire','utilisateurid' => 1],
        ['id' => 5,'datecreation' => '2025-07-18 12:34:02.98374','solde' => 10000.00,'telephone' => '784541151','typecompte' => 'secondaire','utilisateurid' => 1],
        ['id' => 6,'datecreation' => '2025-07-19 01:02:27.837006', 'solde' => 0.00,'telephone' => '771022723','typecompte' => 'secondaire','utilisateurid' => 1]
    ];
;
    $stmtCompte = $pdo->prepare("INSERT INTO comptes (id, datecreation, solde, telephone, typecompte, utilisateurid) VALUES (?, ?, ?, ?, ?, ?)");
    $compteIds = [];
    foreach ($comptes as $compte) {
        $stmtCompte->execute([
            $compte['id'],
            $compte['datecreation'],
            $compte['solde'],
            $compte['telephone'],
            $compte['typecompte'],
            $compte['utilisateurid']
        ]);
    }
    echo "✅ Comptes insérés\n";

    // 4. Transactions
    $transactions = [
        ['id' => 1, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 2, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 2000.00, 'compteid' => 1],
        ['id' => 3, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 1000.00, 'compteid' => 1],
        ['id' => 4, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 5, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 5000.00, 'compteid' => 1],
        ['id' => 6, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 7, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 8, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 9, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 10, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 11, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 12, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 13, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 14, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 15, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 16, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 25000.00, 'compteid' => 1],
        ['id' => 17, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 18, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 19, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 20, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 21, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 22, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 23, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'retrait', 'montant' => 7000.00, 'compteid' => 1],
        ['id' => 24, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 25, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 26, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'depot', 'montant' => 10000.00, 'compteid' => 1],
        ['id' => 27, 'date' => '2025-07-17 21:47:53.028119', 'typetransaction' => 'paiement', 'montant' => 10000.00, 'compteid' => 1],
    ];
    $stmtTrx = $pdo->prepare("INSERT INTO transactions (id, date, typetransaction, montant, compteid) VALUES (?, ?, ?, ?, ?)");
    foreach ($transactions as $trx) {
        $stmtTrx->execute([
            $trx['id'],
            $trx['date'],
            $trx['typetransaction'],
            $trx['montant'],
            $trx['compteid']
        ]);
    }
    echo "✅ Transactions insérées\n";

    $pdo->commit();
    echo "🎉 Données seedées avec succès !\n";

}catch (PDOException $e) {
    $pdo->rollBack();
    die("Erreur lors de l'insertion des données : " . $e->getMessage());
}