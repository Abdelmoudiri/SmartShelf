# Utiliser une image PHP avec Apache comme base
FROM php:8.2-apache

# Définir le répertoire de travail dans le conteneur
WORKDIR /var/www/html

# Installer les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    libpq-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Installer Composer (gestionnaire de dépendances PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copier les fichiers du projet Laravel dans le conteneur
COPY . .

# Installer les dépendances Composer (vendor)
RUN composer install --no-dev --optimize-autoloader

# Configurer les permissions pour le stockage et le cache Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Copier la configuration Apache pour Laravel
COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

# Activer le module Apache rewrite (pour les routes Laravel)
RUN a2enmod rewrite

# Exposer le port 80 (port par défaut d'Apache)
EXPOSE 80

# Définir la commande pour démarrer Apache
CMD ["apache2-foreground"]