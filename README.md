Bookmark
========

Un projet Symfony développé par Cédric Charière Fiedler et Colas Pomies

# Installer
## Prérequis

- PHP 7
- Bower
- Composer

## Installation des vendors
L'application s'appuie sur Composer et Bower.

    composer install

puis

    bower install

et enfin installer les vendors

    php bin\console assets:install

## Exécuter l'application
L'outil embarque une base de données sqlite fournie avec les sources.

    php bin/console server:run

L'application est accessible à l'adresse `localhost:8000/links`

# Travail réalisé

## Application orientée API

L'application s'appuie sur FosRestBundle et sur les nombreux listeners proposés.
En outre de proposer une interface graphique, des points d'entrées REST ont été mis en place, notamment les verbes :
 - GET
 - POST
 - DELETE
L'implémentation de ces points d'entrées pour les liens et les catégories permet l'utilisation des formats HTML, JSON, XML.

Il n'existe pas encore d'option de filtrage par requête, ni d'implémentation concrête des autres méthodes.

La serialization / deserialization est gérée en XML et JSON.

## Worker

Une commande console permet de construire les liens dont seul le lien est enregistré en base. Il nécessite l'utilisation de PHP-CLI.
Selon le système d'exploitation hôte de cette application, une tâche CRON peut  faire appel à cette methode :

    `php bin/console app:build_links`

Le service `AppBundle:Service:LinkBuilderFromWebPage` est dédié à cette construction et s'appuie sur des outils de navigation web et de parcours de DOM.

## Application graphique

La partie graphique s'appuie sur le moteur de rendu Twig et sur la bibliothèque Jquery.

Fonctionnalités intégrées :

	- Ajouter un article
	- Consulter un article
	- Possibilité de mettre un Like sur un article
	- Possibilité d'archiver le article
	- Possibilité de consulter les articles en fonction de Home/Liked/archive
	- Création de nouveau dossier possible
	- Il n'y a pas la gestion d'ajout d'article à un dossier
	- Message d'erreur présent dans les formulaire (Add Link)

Il nous est à l'heure actuel impossible de lier un lien à une catégorie avec l'interface graphique.

Tests :

	- Nous avons développé quelques tests avec casperjs pour tests les appels json
	- Nous avons écris des scénarios en suivant le formalisme de Behart

