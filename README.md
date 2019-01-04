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
+ Non connecté

### Connexion
L'utilisateur n'est pas connecté,

+ dans le menu en haut à droite, une cliquer sur l'onglet "Connexion"
+ Saisir les identifiants

### Inscription
L'utilisateur n'est pas connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Inscription"
+ Saisir les informations

### Profile
L'utilisateur est connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Profil"

Possibilité de modifier les informations du profile

### Deconnexion
L'utilisateur est connecté,

+ Dans le menu en haut à droite, cliquer sur l'onglet "Deconnexion"

## Poste

### Voir les articles

Page par défault

+ Dans le menu en haut à droite, une cliquer sur l'onglet "Accueil"

3 articles par page (Trie par date de publication décroissante), possibilité de lire plus articles en cliquant sur "Anciens articles"

### Poster un article
Seul les utilisateurs connectés peuvent poster un article,

Sur la page d'accueil, en bas de la liste des articles.
+ Remplire les champs
  + Titre : Titre de l'article
  + Contenu : Le contenu de l'article
  + Image url (OPTIONNEL)  : Permet de déposer une image depuis l'ordinateur de l'utilisateur, si aucune image n'est déposé, aucune image ne sera associé à l'article.

Si l'utilisateur est connecté, l'auteur sera <PseudoDeL'utilisateur>.

Si l'utilisateur n'est pas connecté, un message d'erreur apparait.

### Details d'un article

Sur la liste des articles (Page d'accueil)
+ Cliquer sur le bouton "Détails"

Cette page permet de lire l'article en entier.

#### Supprimer un poste

Seul un utilisateur connecté et auteur de l'article peut le supprimer.

Sur la page détails de l'article.
+ Cliquer de "Supprimer"

Si l'utilisateur n'est pas l'auteur, un message d'erreur apparait.

Si l'utilisateur n'est pas connecté, il est redirigé sur la page de connexion.

#### Editer un poste

Seul un utilisateur connecté et auteur de l'article peut l'éditer.

Sur la page détails de l'article.
+ Cliquer de "Editer"

Vous pouvez choisire un nouveau titre et/ou un nouveau texte.

Cliquer sur "Sauvegarder"

Si l'utilisateur n'est pas l'auteur, un message d'erreur apparait.

Si l'utilisateur n'est pas connecté, il est redirigé sur la page de connexion.

### A propos

Une page de présentation, lien vers le répertoire github

# Fonctionnement du blog (Backend)

## Controlleurs

+ BlogController : Renvoie sur les différentes pages du blog
+ CrudController : Gère les différentes actions liées aux "Post" (Details/Edit/Delete), la création est gérer par le BlogController car directement sur la page d'accueil.

## Traductions
Le site est en grande partie traduit en Francais et en Anglais, les tests on été faits en locale en modifiant la valeur parameters->locale fr/en dans https://github.com/Harkame/eApplication-Blog/blob/master/app/config/config.yml

### Formattage des dates

Nous avons pris connaissance de la fonction "localizeddate('long', 'none', 'en')" et de l'exntesion de Twig : intl pour formatter les dates en fonction des locales, cependant nous n'avons pas réussit à faire fonctionner le formattage dans un autre format que "en", il semblerait que cela vienne de la version de php.

## Gestion des utilisateur
FOSUserBundle

https://github.com/FriendsOfSymfony/FOSUserBundle

## CSS

Bootstrap

### Exemple utilisé

https://startbootstrap.com/template-overviews/clean-blog/

## Les images
La gestion est ultra simplifié, l'image est déposé depuis le formulaire (FileType), et enregistré dans le répertoire /web/image/ avec un identifiant unique. Le nom complet de l'image est associé à un poste et sera affiché dans la liste des postes.

## Securité
Les routes d'édition et de suppression d'un poste sont sécurisé par FosUserBundle dans le fichier "security.xml". Si un utilisateur non connecté accède à ses routes, il est redirigé vers la page de connexion.
Dans le cas ou un utilisateur est connecté mais n'est pas l'auteur d'un poste qu'il veut supprimer, un test est fait pour voir si l'utilisateur courant est l'auteur, si oui la modification/suppression est faite, sinon un message d'erreur apparait.

## Les formulaires
Les formulaires de création et de mofication sont gérés par Symfony.

# Ce qui n'a pas été fait
+ Un groupe d'utilisateur ADMIN, pouvant editer ou supprimer TOUS les postes. Dans notre cas, seul l'auteur peut éditer ou supprimer son poste.
+ Une page pour la création, nous avons fait le choix de mettre le formulaire de création directement sur la page d'accueil, en dessous de la liste des postes, ce qui explique que le CrudController n'est pas d'action newPost

# Commentaires sur l'UE
+ Dans ce même UE, nous avons un autre projet (faire un site web), il est probable que certaine personne ne savait pas faire de site web du tout et faire la partie Symfony avant la partie de M. Lafourcade (Plus libre) pourrait être intéressant.
        

             
            

