# 🛒 SmartShelf

## 📌 Description
SmartShelf est une API REST développée avec Laravel permettant une gestion efficace des rayons d’un supermarché. Elle assure la gestion des stocks et des produits en temps réel tout en offrant une authentification sécurisée via Laravel Sanctum.

## 🚀 Fonctionnalités
- 🔐 Authentification et sécurisation des accès avec Laravel Sanctum.
- 🏪 Gestion des rayons : ajout, modification et suppression.
- 📦 Gestion des produits : ajout, modification et suppression.
- 🔍 Consultation des stocks par rayon et recherche de produits par nom ou catégorie.
- ⭐ Affichage des produits populaires et en promotion.
- 🔄 Mise à jour automatique des stocks après chaque vente via Laravel Queues et Jobs.
- ⚠️ Système d’alerte pour les niveaux de stock critiques.
- 📜 Documentation complète de l’API avec Postman ou Swagger.

## 👤 User Stories

### 🛍️ Clients
- ✅ Consulter la liste des produits disponibles dans un rayon spécifique.
- 🔎 Rechercher un produit par son nom ou sa catégorie.
- 🌟 Voir les produits populaires ou en promotion dans un rayon spécifique.

### 👨‍💼 Administrateurs
- ➕ Ajouter, modifier ou supprimer des rayons.
- 📌 Ajouter, modifier ou supprimer des produits dans un rayon.
- 📊 Visualiser des statistiques sur les stocks (produits les plus vendus, niveaux de stock critiques).
- ⚠️ Recevoir une alerte lorsque le stock d’un produit atteint un seuil bas.

### 👨‍💻 Développeurs
- 📖 Fournir une documentation détaillée de l’API.
- 🔄 Mettre à jour automatiquement les stocks après chaque vente en utilisant Laravel Queues et Jobs.

## 🛠️ Installation
1. **📥 Cloner le projet** :
   ```bash
   git clone https://github.com/ABDELHAFIDAIT/smart-shelf.git
   cd smart-shelf
   ```
2. **📦 Installer les dépendances** :
   ```bash
   composer install
   ```
3. **⚙️ Configurer l’environnement** :
   - Dupliquer le fichier `.env.example` et le renommer `.env`
   - Modifier les paramètres de connexion à la base de données
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. **🛢️ Créer la base de données et exécuter les migrations** :
   ```bash
   php artisan migrate --seed
   ```
5. **▶️ Lancer le serveur** :
   ```bash
   php artisan serve
   ```

## 📚 Documentation de l’API
La documentation est générée à l’aide de **Postman** et peut être consultée via :
- 🔗 [Documentation Postman](#)

## 🏗️ Technologies utilisées
- 🖥️ **Laravel 10** – Framework PHP
- 🗄️ **PgSQL** – Base de données
- 🔐 **Laravel Sanctum** – Authentification API
- 🔄 **Laravel Schedule** – Gestion des mises à jour automatiques des stocks
- 📜 **Postman** – Documentation de l’API

## 🤝 Contribuer
Les contributions sont les bienvenues ! Merci de suivre les étapes suivantes :
1. 🍴 Forker le projet.
2. 🌿 Créer une branche pour votre fonctionnalité (`git checkout -b feature-nom`).
3. 💾 Commiter vos modifications (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`).
4. 📤 Pousser la branche (`git push origin feature-nom`).
5. 🔄 Ouvrir une Pull Request.

## 📜 Licence
Ce projet est sous licence MIT. Voir le fichier `LICENSE` pour plus de détails.