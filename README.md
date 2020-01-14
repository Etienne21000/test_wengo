# Test technique réalisé pour MyBestPro


Menu :
 1. Outils
 2. Description
 3. Choix techniques
 4. Test de l'application


## 1. Outils :

 - Symfony 4
 - Php 7.3
 - Doctrine
 - Twig


## 2. Description :

Réalisation d'un CRUD pour la gestion de tâche dans un back-office avec Symfony basé sur le design pattern MVC.

<br/>

 - Installation de Symfony via Composer `symfony/website-skeleton`.
 - Création des *Entity* et *Controller* via les commandes de **Maker**.
 - Création de la base de données et migration via la *console*.
 - Génération de fausses données avec l'outil de *Doctrine* fixtures
 - Utilisation du serveur interne fourni par Symfony-CLI.

<br/>

 - Gestion de la base de donnée avec l'ORM *Doctrine*.
 - Gestion du templating avec *Twig* : création d'un template parent à tous les autres templates.

<br/>

 - **Create task :** utilisation d'un formulaire Symfony.
 - **Update task :** utilisation d'un formulaire Symfony.
 - **Delete task :** utilisation du service de formulaire de Symfony

<br/>

## 3. Choix techniques :

 - Tri des tâches : par état de traitement de la tâche pour la page répertoriant toutes les tâches.
 - Tri par état de taches : tri par date de création / modification / date de fin.
 - Définition de l'état de la tâche : dans le formuaire de création / d'édition (à faire, en cours et terminée).
 - Date de fin : définie dans Entity Task avec Doctrine lifeCycle PrePersist et PreUpdate avec ajout d'une condition de l'état qui doit être passé à terminée.

<br/>

Controllers :
<br/>
 - Définition des routes dans les annotations de chaque méthode.
 - Utilisation du service de routing de Symfony.

<br/>

4. Guide d'installation du projet :
<br/>
```sh
composer install
```

cloner url git hub :
```sh
git clone https://github.com/Etienne21000/test_wengo.git
```

Installer dépendances composer
```sh
bin/console 
```

Créer la bdd et éxecuter les migrations
```sh
bin/console doctrine:database:create
``` 

```sh
bin/console doctrine:migrations:migrate
```

Charger les fixtures : 
```sh
bin/console make:fixtures
```

Utilisation de la base de donnée par l'ORM : server local (MAMP)
