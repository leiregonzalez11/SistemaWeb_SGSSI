FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli
#PROD ADD app/ /var/www/html/