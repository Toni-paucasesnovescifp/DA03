FROM php:8.3-apache

# Instal·lar extensions de PHP necessàries per a Laravel i MySQL
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Activar mod_rewrite d'Apache
RUN a2enmod rewrite

# Copiar el codi del projecte
COPY . /var/www/html

# Donar permisos a les carpetes de Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Fixar el DocumentRoot d'Apache a la carpeta public de Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

EXPOSE 80
