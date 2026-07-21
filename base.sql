PRAGMA foreign_keys = ON;

CREATE TABLE autres_operateurs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    commission_transfert REAL NOT NULL DEFAULT 0
        CHECK(commission_transfert >= 0),
    actif INTEGER NOT NULL DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT NOT NULL UNIQUE,
    type TEXT NOT NULL
        CHECK(type IN ('local', 'externe')),
    autre_operateur_id INTEGER,
    actif INTEGER NOT NULL DEFAULT 1,
    FOREIGN KEY (autre_operateur_id)
        REFERENCES autres_operateurs(id)
        ON DELETE SET NULL
);

CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL,
    prenom TEXT NOT NULL,
    email TEXT NOT NULL UNIQUE,
    telephone TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    role TEXT NOT NULL CHECK(role IN ('admin')),
    actif INTEGER NOT NULL DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT DEFAULT 'Client',
    telephone TEXT NOT NULL UNIQUE,
    solde REAL NOT NULL DEFAULT 0 CHECK(solde >= 0),
    actif INTEGER NOT NULL DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE types_operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

CREATE TABLE baremes_frais (
    id INTEGER PRIMARY KEY AUTOINCREMENT,

    type_operation_id INTEGER NOT NULL,

    montant_min REAL NOT NULL,
    montant_max REAL NOT NULL,

    frais REAL NOT NULL CHECK(frais >= 0),

    date_modification DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(type_operation_id)
        REFERENCES types_operations(id)
        ON DELETE CASCADE,

    CHECK(montant_min <= montant_max)
);

CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,

    reference TEXT UNIQUE,

    type_operation_id INTEGER NOT NULL,

    expediteur_id INTEGER,
    destinataire_id INTEGER,
    autre_operateur_id INTEGER,

    montant REAL NOT NULL CHECK(montant > 0),
    frais REAL NOT NULL DEFAULT 0 CHECK(frais >= 0),
    commission REAL NOT NULL DEFAULT 0 CHECK(commission >= 0),

    description TEXT,

    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(type_operation_id)
        REFERENCES types_operations(id),

    FOREIGN KEY(expediteur_id)
        REFERENCES clients(id)
        ON DELETE SET NULL,

    FOREIGN KEY(destinataire_id)
        REFERENCES clients(id)
        ON DELETE SET NULL,

    FOREIGN KEY(autre_operateur_id)
        REFERENCES autres_operateurs(id)
        ON DELETE SET NULL
);

CREATE TABLE promotion(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    pourcentage REAL
);

--
INSERT INTO autres_operateurs
(nom, commission_transfert)
VALUES
('MVola', 5),
('Airtel Money', 3);

INSERT INTO prefixes(prefixe, type, actif, autre_operateur_id) VALUES
('033', 'local', 1, NULL),
('037', 'local', 1, NULL),
('034', 'externe', 1, 1),
('038', 'externe', 1, 1);

INSERT INTO types_operations(nom) VALUES
('Depot'),
('Retrait'),
('Transfert');

-- Administrateur
INSERT INTO users(
    nom,
    prenom,
    email,
    telephone,
    password,
    role
)
VALUES(
    'Admin',
    'Systeme',
    'admin1@mobilemoney.mg',
    '0331111111',
    '$2y$12$nHqQ8ObUyW8jCRAMDetZfOMWe1rp.EYFhQOEakI7nrdPMTUrpcQFC',
    'admin'
);

INSERT INTO clients
(nom, telephone, solde, actif)
VALUES
('Rakoto Jean', '0331234567', 150000, 1),
('Hery Paul', '0337654321', 120000, 1);

INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(1,0,999999999,0);

INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(2,0,10000,500),
(2,10001,50000,1000),
(2,50001,100000,2000),
(2,100001,999999999,3000);

INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(3,0,10000,300),
(3,10001,50000,700),
(3,50001,100000,1200),
(3,100001,999999999,2000);

INSERT INTO promotion(pourcentage) VALUES (0.05);