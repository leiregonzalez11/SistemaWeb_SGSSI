FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli


#Posible solución a permisos aquí; https://stackoverflow.com/questions/44716612/docker-php-permissions/44716835
ADD app/ /var/www/html/
RUN sed -ri 's/^www-data:x:82:82:/www-data:x:1000:50:/' /etc/passwd
RUN chown -R www-data:www-data /var/www/html
