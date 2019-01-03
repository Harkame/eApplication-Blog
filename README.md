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

[x] L'utilisateur n'est pas connecté,
+ dans le menu en haut à droite, une cliquer sur l'onglet "Connexion"
+ Saisire les identifiants

### Inscription

Si l'utilisateur n'est pas connecté,
+ Dans le menu en haut à droite, cliquer sur l'onglet "Inscription"
+ Saisire les informations

### Profile

Si l'utilisateur est connecté,
+ Dans le menu en haut à droite, cliquer sur l'onglet "Profile"

Possibilité de modifier les informations du profile

### Deconnexion

Si l'utilisateur est connecté,
+ Dans le menu en haut à droite, cliquer sur l'onglet "Deconnexion"

## Poste

### Lire un article

Page par défault

+ Dans le menu en haut à droite, une cliquer sur l'onglet "Accueil"

3 articles par page (Trie par date de publication décroissante), possibilité de lire d'anciens articles en cliquant sur "Anciens articles"

### Poster un message

Tout le monde peut poster un message.

Si l'utilisateur n'est pas connecté, l'auteur sera "Anonymous"

Si l'utilisateur est connecté, l'auteur sera <PseudoDeL'utilisateur>

### Details d'un article

#### Supprimer un poste

Seul les utilisateurs connectés peuvent supprimer un poste

#### Editer un poste

Seul les utilisateurs connectés peuvent supprimer un poste

### A propos

Une page en plus

# Fonctionnement du blog (Backed)

# Commentaires sur l'UE
+ Dans ce même eu, nous avons un autre projet (faire un site web), il est probable que certaine personne ne savait pas faire de site web du tout et faire la partie symfony avant la partie de M. Lafourcade pourrait être intéressant.
        

             
            

