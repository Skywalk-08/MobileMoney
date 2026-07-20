PRAGMA foreign_keys = ON;

-- ==========================================
-- TABLE DES PREFIXES
-- ==========================================
CREATE TABLE prefixes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    prefixe TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

-- ==========================================
-- UTILISATEURS DE L'APPLICATION (ADMIN)
-- ==========================================
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

-- ==========================================
-- CLIENTS MOBILE MONEY
-- Créés automatiquement lors du premier login
-- ==========================================
CREATE TABLE clients (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT DEFAULT 'Client',
    telephone TEXT NOT NULL UNIQUE,
    solde REAL NOT NULL DEFAULT 0 CHECK(solde >= 0),
    actif INTEGER NOT NULL DEFAULT 1,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- ==========================================
-- TYPES D'OPERATIONS
-- ==========================================
CREATE TABLE types_operations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    nom TEXT NOT NULL UNIQUE,
    actif INTEGER NOT NULL DEFAULT 1
);

-- ==========================================
-- BAREMES DES FRAIS
-- ==========================================
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

-- ==========================================
-- TRANSACTIONS
-- ==========================================
CREATE TABLE transactions (
    id INTEGER PRIMARY KEY AUTOINCREMENT,

    reference TEXT UNIQUE,

    type_operation_id INTEGER NOT NULL,

    expediteur_id INTEGER,
    destinataire_id INTEGER,

    montant REAL NOT NULL CHECK(montant > 0),
    frais REAL NOT NULL DEFAULT 0 CHECK(frais >= 0),

    description TEXT,

    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY(type_operation_id)
        REFERENCES types_operations(id),

    FOREIGN KEY(expediteur_id)
        REFERENCES clients(id)
        ON DELETE SET NULL,

    FOREIGN KEY(destinataire_id)
        REFERENCES clients(id)
        ON DELETE SET NULL
);

-- ==========================================
-- DONNEES INITIALES
-- ==========================================

-- Préfixes
INSERT INTO prefixes(prefixe) VALUES
('032'),
('033'),
('034'),
('038');

-- Types d'opérations
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

-- Barèmes Dépôt (gratuit)
INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(1,0,999999999,0);

-- Barèmes Retrait
INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(2,0,10000,500),
(2,10001,50000,1000),
(2,50001,100000,2000),
(2,100001,999999999,3000);

-- Barèmes Transfert
INSERT INTO baremes_frais(type_operation_id,montant_min,montant_max,frais)
VALUES
(3,0,10000,300),
(3,10001,50000,700),
(3,50001,100000,1200),
(3,100001,999999999,2000);