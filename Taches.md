=====================================================
TODO - PROJET MOBILE MONEY 
=====================================================


=====================================================
1. INITIALISATION DU PROJET (Windy)
=====================================================

- Configurer SQLite (fini)
- Créer la base de données mobilemoney.db (fini)
- Configurer la connexion à SQLite (fini)

=====================================================
2. BASE DE DONNÉES (Windy)
=====================================================

Créer les tables suivantes :
prefixes (fini)
clients (fini)
types_operations (fini)
baremes_frais (fini)
transactions (fini)

=====================================================
3. MODULE OPÉRATEUR (Windy)
=====================================================

3.1 Gestion des préfixes
Ajouter un préfixe
Modifier un préfixe
Supprimer un préfixe
Activer/Désactiver un préfixe
Afficher la liste des préfixes

-----------------------------------------------------

3.2 Gestion des types d'opérations
Dépôt
Retrait
Transfert

Fonctionnalités :
Ajouter
Supprimer
Activer/Désactiver

-----------------------------------------------------

3.3 Gestion des barèmes de frais

Chaque type d'opération possède plusieurs tranches.

Fonctionnalités :

Ajouter une tranche
Modifier une tranche
Supprimer une tranche
Vérifier l'absence de chevauchement des tranches

-----------------------------------------------------

3.4 Tableau de bord opérateur

Situation des gains
Total frais dépôt
Total frais retrait
Total frais transfert
Gain total

Situation des comptes clients
Nombre de clients
Solde total
Client le plus riche
Client le plus actif

=====================================================
4. MODULE CLIENT (Natanaela)
=====================================================

4.1 Connexion 
Fonctionnement :
Saisie du numéro de téléphone (fini)
Vérification du préfixe (fini)
Si le numéro n'existe pas :
      création automatique du compte (en cours)
Connexion automatique (fini)

=====================================================
5. TABLEAU DE BORD CLIENT (Natanaela)
=====================================================

Afficher :
Numéro de téléphone (fini)
Solde actuel (fini)
Accès aux opérations (fini)

=====================================================
6. DÉPÔT (Natanaela)
=====================================================
Fonctionnalités :
Saisie du montant (fini)
Calcul automatique des frais (fini)
Crédit du compte (fini)
Enregistrement de la transaction (fini)

=====================================================
7. RETRAIT (Natanaela)
=====================================================

Fonctionnalités :
Vérification du solde
Calcul automatique des frais
Débit du compte
Enregistrement de la transaction

Gestion des erreurs :
Solde insuffisant

=====================================================
8. TRANSFERT (Natanaela)
=====================================================

Fonctionnalités :

Saisie du numéro destinataire
Vérification du préfixe
Création automatique du destinataire si inexistant
 Vérification du solde
Calcul des frais
Débit de l'expéditeur
Crédit du destinataire
Enregistrement de la transaction

Gestion des erreurs :

Solde insuffisant
Numéro invalide

=====================================================
9. HISTORIQUE DES OPÉRATIONS (Natanaela)
=====================================================

Afficher :
- Dépôts
- Retraits
- Transferts envoyés
- Transferts reçus
(fini)

Informations affichées :
- Date
- Type d'opération
- Montant
- Frais
- Solde après opération

=====================================================
10. CALCUL DES FRAIS (Windy)
=====================================================

Controller de calcul des frais 
Fonctionnalités :
- Rechercher la tranche correspondant au montant
- Retourner le montant des frais
- Retourner 0 si aucun barème
