FROM php:8.2-apache

# Instalar extensión MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Copiar todo el proyecto
COPY . /var/www/html/

# Apuntar Apache a la carpeta public/
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' \
    /etc/apache2/sites-available/000-default.conf

RUN sed -i 's|<Directory /var/www/html>|<Directory /var/www/html/public>|g' \
    /etc/apache2/sites-available/000-default.conf

# Habilitar mod_rewrite para el router
RUN a2enmod rewrite

EXPOSE 80