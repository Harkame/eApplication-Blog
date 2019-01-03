# Auteurs
+ Louis DAVIAUD
+ Baptiste VOLLE

# URL
https://louis-daviaud-blog.herokuapp.com/

# Compte

+ Nom d'utilisateur : TestUser
+ Adresse e-mail : test_user@gmail.com
+ Mot de passe : TestUser123

# Installation

``` bash
composer install
```

``` bash
composer update
```

# Usage

Executer le script "run.sh"

## Autres scripts (/script)

+ database.sh : Réinitialise la base de données (create schema + create sqlite.db)
+ database_prod.sh : Réinitialise la base de données en production (DANGER)
+ entity.sh : Génère l'entitée Post (Post.php)
+ translate.sh : Mets à jour les traductions

# Présentation du blog

## Utilisateur

Il y a 2 types d'utilisateurs
        + Connecté
        + Non connecté (Anonyme)

### Connexion
L'utilisateur n'est pas connecté,

+ dans le menu en haut à droite, une cliquer sur l'onglet "Connexion"
+ Saisire les identifiants

### Inscription
L'utilisateur n'est pas connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Inscription"
+ Saisire les informations

### Profile
L'utilisateur est connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Profile"

Possibilité de modifier les informations du profile

### Deconnexion
L'utilisateur est connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Deconnexion"

## Poste

### Voir les articles

Page par défault

+ Dans le menu en haut à droite, une cliquer sur l'onglet "Accueil"

3 articles par page (Trie par date de publication décroissante), possibilité de lire d'anciens articles en cliquant sur "Anciens articles"

### Poster un article
Seul les utilisateurs connectés peuvent poster un article,

Sur la page d'accueil, en bas de la liste des articles.
+ Remplire les champs
+ + Titre : Titre de l'article
+ + Contenu : Le contenu de l'article
+ + Image url  : Permet de déposer une image depuis l'ordinateur de l'utilisateur

Si l'utilisateur est connecté, l'auteur sera <PseudoDeL'utilisateur>.

Si l'utilisateur n'est pas connecté, il est redirigé sur la page de connexion.

### Details d'un article

Sur la liste des articles (Page d'accueil)
+ Cliquer sur le bouton "Détails"

Cette page permet de lire l'article en entier.

#### Supprimer un poste

Seul un utilisateur connecté et auteur de l'article peut le supprimer.

Sur la page détails de l'article.
+ Cliquer de "Supprimer"

#### Editer un poste

Seul un utilisateur connecté et auteur de l'article peut l'éditer.

Sur la page détails de l'article.
+ Cliquer de "Editer"

Vous pouvez choisire un nouveau titre et/ou un nouveau texte.

Cliquer sur "Sauvegarder"

### A propos

Une page de présentation, lien vers le répertoire github

# Fonctionnement du blog (Backend)

## Controlleurs

+ BlogController : Renvoie sur les différentes pages du blog
+ CrudController : Gère les différentes actions liées aux "Post" (Details/Edit/Delete), la création est gérer par le BlogController car directement sur la page d'accueil.

## Traductions
Le site est en grande partie traduit en Francais et en Anglais, les tests on été faits en locale en modifiant la valeur parameters->locale fr/en dans https://github.com/Harkame/eApplication-Blog/blob/master/app/config/config.yml

## Les images
La gestion est simple, les images 

# Commentaires sur l'UE
+ Dans ce même eu, nous avons un autre projet (faire un site web), il est probable que certaine personne ne savait pas faire de site web du tout et faire la partie symfony avant la partie de M. Lafourcade pourrait être intéressant.
        

             
            

