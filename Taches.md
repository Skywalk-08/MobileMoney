=====================================================
TODO - PROJET MOBILE MONEY 
=====================================================


=====================================================
1. INITIALISATION DU PROJET (Windy)
=====================================================

- Configurer SQLite (fini)
- Créer la base de données mobilemoney.db
- Configurer la connexion à SQLite (fini)

=====================================================
2. BASE DE DONNÉES
=====================================================

Créer les tables suivantes :

[ ] prefixes
[ ] clients
[ ] types_operations
[ ] baremes_frais
[ ] transactions

=====================================================
3. MODULE OPÉRATEUR
=====================================================

3.1 Gestion des préfixes

[ ] Ajouter un préfixe
[ ] Modifier un préfixe
[ ] Supprimer un préfixe
[ ] Activer/Désactiver un préfixe
[ ] Afficher la liste des préfixes

Exemple :
- 033
- 037

-----------------------------------------------------

3.2 Gestion des types d'opérations

[ ] Dépôt
[ ] Retrait
[ ] Transfert

Fonctionnalités :

[ ] Ajouter
[ ] Modifier
[ ] Supprimer
[ ] Activer/Désactiver

-----------------------------------------------------

3.3 Gestion des barèmes de frais

Chaque type d'opération possède plusieurs tranches.

Exemple :

0 - 10 000        => 200 Ar
10 001 - 50 000   => 500 Ar
50 001 - 100 000  => 1 000 Ar

Fonctionnalités :

[ ] Ajouter une tranche
[ ] Modifier une tranche
[ ] Supprimer une tranche
[ ] Vérifier l'absence de chevauchement des tranches

-----------------------------------------------------

3.4 Tableau de bord opérateur

Situation des gains

[ ] Total frais dépôt
[ ] Total frais retrait
[ ] Total frais transfert
[ ] Gain total

Situation des comptes clients

[ ] Nombre de clients
[ ] Solde total
[ ] Client le plus riche
[ ] Client le plus actif

=====================================================
4. MODULE CLIENT
=====================================================

4.1 Connexion

Aucune inscription.

Fonctionnement :

[ ] Saisie du numéro de téléphone
[ ] Vérification du préfixe
[ ] Si le numéro n'existe pas :
      création automatique du compte
[ ] Connexion automatique

=====================================================
5. TABLEAU DE BORD CLIENT
=====================================================

Afficher :

[ ] Numéro de téléphone
[ ] Solde actuel
[ ] Accès aux opérations

=====================================================
6. DÉPÔT
=====================================================

Hypothèse :
Le dépôt est automatique.

Fonctionnalités :

[ ] Saisie du montant
[ ] Calcul automatique des frais
[ ] Crédit du compte
[ ] Enregistrement de la transaction

=====================================================
7. RETRAIT
=====================================================

Fonctionnalités :

[ ] Vérification du solde
[ ] Calcul automatique des frais
[ ] Débit du compte
[ ] Enregistrement de la transaction

Gestion des erreurs :

[ ] Solde insuffisant

=====================================================
8. TRANSFERT
=====================================================

Fonctionnalités :

[ ] Saisie du numéro destinataire
[ ] Vérification du préfixe
[ ] Création automatique du destinataire si inexistant
[ ] Vérification du solde
[ ] Calcul des frais
[ ] Débit de l'expéditeur
[ ] Crédit du destinataire
[ ] Enregistrement de la transaction

Gestion des erreurs :

[ ] Solde insuffisant
[ ] Numéro invalide

=====================================================
9. CONSULTATION DU SOLDE
=====================================================

[ ] Afficher le solde actuel
[ ] Afficher la date de mise à jour

=====================================================
10. HISTORIQUE DES OPÉRATIONS
=====================================================

Afficher :

[ ] Dépôts
[ ] Retraits
[ ] Transferts envoyés
[ ] Transferts reçus

Informations affichées :

[ ] Date
[ ] Type d'opération
[ ] Montant
[ ] Frais
[ ] Solde après opération

=====================================================
11. CALCUL DES FRAIS
=====================================================

Créer un service de calcul des frais.

Fonctionnalités :

[ ] Rechercher la tranche correspondant au montant
[ ] Retourner le montant des frais
[ ] Retourner 0 si aucun barème

=====================================================
12. VALIDATIONS
=====================================================

[ ] Vérifier que le numéro est valide
[ ] Vérifier que le préfixe existe
[ ] Vérifier que le montant est positif
[ ] Vérifier que le solde est suffisant
[ ] Vérifier que l'expéditeur et le destinataire sont différents

=====================================================
13. INTERFACES
=====================================================

Client

[ ] Login
[ ] Tableau de bord
[ ] Dépôt
[ ] Retrait
[ ] Transfert
[ ] Historique

Opérateur

[ ] Tableau de bord
[ ] Gestion des préfixes
[ ] Gestion des types d'opérations
[ ] Gestion des barèmes
[ ] Situation des gains
[ ] Situation des comptes clients

=====================================================
14. BONUS (OPTIONNEL)
=====================================================

[ ] Recherche dans l'historique
[ ] Pagination
[ ] Filtre par date
[ ] Graphiques des gains
[ ] Export PDF
[ ] Export Excel

=====================================================
LIVRABLES
=====================================================

[ ] Projet CodeIgniter 4 fonctionnel
[ ] Base SQLite embarquée
[ ] Interface Bootstrap responsive
[ ] Gestion des préfixes
[ ] Gestion des types d'opérations
[ ] Gestion des barèmes de frais
[ ] Connexion automatique par numéro
[ ] Dépôt
[ ] Retrait
[ ] Transfert
[ ] Consultation du solde
[ ] Historique des opérations
[ ] Tableau de bord opérateur