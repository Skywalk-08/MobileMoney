# TODO - Projet Mobile Money

## 1. Initialisation du projet (Windy)

- [x] Configurer SQLite
- [x] Créer la base de données `mobilemoney.db`
- [x] Configurer la connexion à SQLite

---

# 2. Base de données (Windy)

## Création des tables

- [x] Table `prefixes`
- [x] Table `clients`
- [x] Table `types_operations`
- [x] Table `baremes_frais`
- [x] Table `transactions`

---

# 3. Module Opérateur (Windy)

## 3.1 Gestion des préfixes

### Fonctionnalités

- [x] CRUD prefixe
- [ ] Activer / Désactiver un préfixe
- [x] Afficher la liste des préfixes


---

## 3.2 Gestion des types d'opérations 

### Fonctionnalités

- [x] Ajouter un type d'opération
- [x] Supprimer un type d'opération
- [x] Activer / Désactiver un type d'opération


---

## 3.3 Gestion des barèmes de frais

> Une opération -> plusieurs tranches de frais.
> Chaque opération a son propre bareme de frais

### Fonctionnalités

- [x] CRUD frais
- [ ] Vérifier l'absence de chevauchement entre les tranches


---

## 3.4 Tableau de bord opérateur

### Situation des gains

- [x] Afficher le total des frais de dépôt
- [x] Afficher le total des frais de retrait
- [x] Afficher le total des frais de transfert
- [x] Afficher le gain total


### Situation des comptes clients

- [x] Nombre total de clients
- [x] Solde total des comptes
- [x] Client le plus actif


---

# 4. Module Client (Natanaela)

## 4.1 Connexion client

### Fonctionnement

- [x] Saisie du numéro de téléphone
- [x] Vérification du préfixe
- [x] Création automatique du compte si le numéro n'existe pas
- [x] Connexion automatique


---

# 5. Tableau de bord Client (Natanaela)

### Informations affichées

- [x] Numéro de téléphone
- [x] Solde actuel
- [x] Accès aux opérations


---

# 6. Dépôt (Natanaela)

### Fonctionnalités

- [x] Saisie du montant
- [x] Calcul automatique des frais
- [x] Crédit du compte client
- [x] Enregistrement de la transaction


---

# 7. Retrait (Natanaela)

### Fonctionnalités

- [x] Vérification du solde
- [x] Calcul automatique des frais
- [x] Enregistrement de la transaction


### Gestion des erreurs

- [ ] Solde insuffisant


---

# 8. Transfert (Natanaela)

### Fonctionnalités

- [x] Saisie du numéro du destinataire
- [ ] Vérification du préfixe
- [ ] Création automatique du destinataire si inexistant (à verifier)
- [ ] Vérification du solde de l'expéditeur
- [x] Calcul automatique des frais
- [x] Débit du compte expéditeur
- [x] Crédit du compte destinataire
- [x] Enregistrement de la transaction


### Gestion des erreurs

- [ ] Solde insuffisant
- [ ] Numéro invalide (à verifier)


---

# 9. Historique des opérations (Natanaela)

### Types d'opérations affichées

- [x] Dépôts
- [x] Retraits
- [x] Transferts envoyés
- [x] Transferts reçus


### Informations affichées

- [x] Date
- [x] Type d'opération
- [x] Montant
- [x] Frais
- [x] Solde après opération


---

# 10. Calcul des frais (Windy)

## Controller de calcul des frais

### Fonctionnalités

- [ ] Rechercher la tranche correspondant au montant
- [ ] Retourner le montant des frais
- [ ] Retourner `0` si aucun barème trouvé


