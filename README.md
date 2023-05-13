<p align="center">
    <a href="https://www.kaffein.agency/" target="_blank">
        <img src="https://www.hubspot.com/hs-fs/hub/53/file-1809458809-png/HubSpot_logo-14.png" width="400" alt="Hubspot Logo">
    </a>
</p>

<p align="center">
X
</p>

<p align="center">
    <a href="https://www.hubspot.fr/" target="_blank">
        <img src="https://www.kaffein.agency/wp-content/uploads/2023/01/Kaffein_blanc.png" width="400" alt="Kaffein logo" />
    </a>
</p>

## Introduction

Ce projet est un test technique pour l'entreprise Kaffein. Il s'agit d'une application web permettant de gérer des entreprises et ses contacts. L'application est développée avec le framework PHP Laravel, le framework VueJS et il utilise l'API de Hubspot pour récupérer les données et les insérer dans la base de données.

## Installation

### Prérequis

- PHP 8.1 ou supérieur
- Composer
- NodeJS
- NPM

### Installation

1. Cloner le projet
2. Installer les dépendances PHP avec la commande `composer install`
3. Installer les dépendances JS avec la commande `npm install`
4. Créer un fichier `.env` à partir du fichier `.env.example` et rentrer la clé d'API de Hubspot
5. Générer une clé d'application avec la commande `php artisan key:generate`
6. Lancer la compilation des assets avec la commande `npm run dev` (ou `npm run watch` pour la compilation automatique après chaque modification)
7. Lancer le serveur avec la commande `php artisan serve`
8. Se rendre sur l'adresse [http://localhost:8000](http://localhost:8000) pour accéder à l'application
9. Lancer l'import des données avec la commande `php artisan hubspot-import:companies` (ou `php artisan hubspot-import:all` pour tout importer)

## Fonctionnalités

- Importation des entreprises depuis l'API Hubspot
- Importation des contacts des entreprises depuis l'API Hubspot
- Affichage de la liste des entreprises
- Affichage des détails d'une entreprise
- Affichage de la liste des contacts d'une entreprise
