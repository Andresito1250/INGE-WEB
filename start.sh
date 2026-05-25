#!/bin/sh
# Iniciar PHP-FPM
php-fpm82 -D

# Iniciar Nginx
nginx -g "daemon off;"