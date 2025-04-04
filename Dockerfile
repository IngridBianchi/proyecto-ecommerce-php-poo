FROM php:7.4-apache

# Instalar extensiones necesarias
RUN docker-php-ext-install mysqli

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el código de la aplicación
COPY . /var/www/html

# Establecer permisos
RUN chown -R www-data:www-data /var/www/html