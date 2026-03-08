# Ludothèque — Projet Web APP 2026

## Description
Application web de gestion d'une ludothèque associative étudiante.
Gestion des jeux, emprunts, locations, réservations et événements.

## Technologies
- **Frontend** : HTML5, CSS3, Bootstrap 5, JavaScript, jQuery, AJAX
- **Backend** : PHP 8 (MVC natif)
- **Base de données** : MySQL 8
- **Versioning** : Git

## Installation

1. **Cloner le projet** dans le dossier de votre serveur web (htdocs, www, etc.)
2. **Importer la base de données** :
   ```
   mysql -u root -p < sql/create_database.sql
   ```
3. **Configurer la connexion** dans `config/database.php` (host, user, pass)
4. **Configurer l'URL** dans `config/config.php` (SITE_URL)
5. **Activer le mod_rewrite** Apache pour le .htaccess

## Comptes de test

| Rôle | Email | Mot de passe |
|------|-------|-------------|
| Président | president@ludotheque.fr | password123 |
| Admin | admin1@ludotheque.fr | password123 |
| Membre | membre1@ludotheque.fr | password123 |
| Non-membre | user1@email.com | password123 |

## Structure du projet
```
ludotheque/
├── config/          # Configuration (BDD, constantes, init)
├── controllers/     # Contrôleurs (logique métier)
├── models/          # Modèles (accès BDD)
├── views/           # Vues (templates HTML/PHP)
├── public/          # Ressources statiques (CSS, JS, images)
├── helpers/         # Fonctions utilitaires
├── sql/             # Scripts SQL
└── index.php        # Front Controller (routeur)
```
