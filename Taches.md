# TODO - Projet Mobile Money V1

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

- [x] Rechercher la tranche correspondant au montant
- [x] Retourner le montant des frais
- [x] Retourner `0` si aucun barème trouvé


# TODO - Nouvelles fonctionnalités V2

---

# Côté Opérateur (Windy)

## 1. Gestion des autres opérateurs

Créer une page permettant de gérer les opérateurs externes.

### Fonctionnalités

- [ ] Ajouter un opérateur
- [ ] Modifier un opérateur
- [ ] Supprimer un opérateur
- [ ] Activer / Désactiver un opérateur

### Informations à gérer

- [ ] Nom de l'opérateur
- [ ] Préfixes associés (031, 032, ...)
- [ ] Statut


---

## 2. Configuration des préfixes externes

Créer une page de gestion des préfixes des autres opérateurs.

### Fonctionnalités

- [ ] Ajouter un préfixe
- [ ] Modifier un préfixe
- [ ] Supprimer un préfixe
- [ ] Associer un préfixe à un opérateur

### Exemple

```text
031 → Opérateur A
032 → Opérateur B
```

---

## 3. Commission des transferts inter-opérateurs

Créer une page de configuration des commissions.

### Fonctionnalités

- [ ] Définir un pourcentage supplémentaire
- [ ] Modifier le pourcentage
- [ ] Activer / Désactiver la commission

## 4. Tableau de bord des gains

Modifier la page **Situation des gains via les différents frais**.

### Informations à afficher

- [ ] Gains sur les opérations internes
- [ ] Gains sur les opérations vers d'autres opérateurs
- [ ] Total des gains


---

## 5. Situation des montants à reverser aux opérateurs

Créer une page récapitulative.

### Informations à afficher

- [ ] Nom de l'opérateur
- [ ] Nombre de transferts
- [ ] Montant total à reverser

---

# Côté Client (Natanaela)

## 6. Option « Inclure les frais de retrait »

Ajouter une option dans la page de transfert.

### Interface

- [ ] Ajouter une case à cocher **« Inclure les frais de retrait »**

### Fonctionnement

Si la case est cochée :

- [ ] Calculer les frais de retrait
- [ ] Ajouter les frais au montant envoyé

Sinon :

- [ ] Effectuer un transfert normal

---

## 7. Transfert multiple

Créer une nouvelle page.

### Route

```text
/client/transfert-multiple
```

### Fonctionnalités

- [ ] Ajouter plusieurs numéros destinataires
- [ ] Saisir le montant total
- [ ] Répartir automatiquement le montant entre les destinataires
- [ ] Calculer les frais
- [ ] Vérifier le solde
- [ ] Effectuer tous les transferts
- [ ] Enregistrer chaque transaction

---

## 8. Historique des opérations

Améliorer la page d'historique.

### Afficher

- [ ] Transferts internes
- [ ] Transferts vers d'autres opérateurs
- [ ] Transferts multiples

### Fonctionnalités

- [ ] Ajouter un filtre par type d'opération

---