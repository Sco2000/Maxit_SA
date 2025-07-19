CREATE TABLE Profil (
    id SERIAL PRIMARY KEY,
    nomProfil VARCHAR(100) NOT NULL
)

CREATE TABLE Utilisateurs (
    id SERIAL PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    login VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    numeroCarteIdentite VARCHAR(50) UNIQUE,
    photoRecto TEXT,
    photoVerso TEXT,
    adresse TEXT
);


CREATE TABLE Comptes (
    id SERIAL PRIMARY KEY,
    dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    solde DECIMAL(15, 2) DEFAULT 0.00,
    telephone VARCHAR(20) NOT NULL UNIQUE,
    typeCompte VARCHAR(20) NOT NULL CHECK (typecompte IN ('principal', 'secondaire')), 
    utilisateurId INTEGER NOT NULL,
    FOREIGN KEY (utilisateurId) REFERENCES Utilisateurs(id) 
);


CREATE TABLE Transactions (
    id SERIAL PRIMARY KEY,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    typeTransaction VARCHAR(20) NOT NULL CHECK (typetransaction IN ('depot', 'retrait', 'paiement')), 
    montant DECIMAL(15, 2) NOT NULL,
    compteId INTEGER NOT NULL,
    FOREIGN KEY (compteId) REFERENCES Comptes(id)
);