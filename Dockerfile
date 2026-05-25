FROM nginx:alpine

# Instalar PHP-FPM
RUN apk add --no-cache php82 php82-fpm php82-pdo php82-pdo_mysql php82-session php82-mbstring

# Crear symlink para que funcione como 'php'
RUN ln -sf /usr/bin/php82 /usr/bin/php

# Copiar proyecto
COPY . /var/www/html/

# Copiar configuración nginx
COPY nginx.conf /etc/nginx/nginx.conf

# Permisos
RUN chown -R nginx:nginx /var/www/html

# Copiar y dar permisos al script de inicio
COPY start.sh /start.sh
RUN chmod +x /start.sh

EXPOSE 80

CMD ["/start.sh"]