FROM php:8.3-apache

# Instal·lar extensions i eines del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# INSTAL·LAR COMPOSER (Aquesta és la clau)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Activar mod_rewrite d'Apache
RUN a2enmod rewrite

# Copiar el codi
COPY . /var/www/html

# Permisos
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# DocumentRoot
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

EXPOSE 80
