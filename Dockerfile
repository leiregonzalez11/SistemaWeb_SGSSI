FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli

#Gracias a https://stackoverflow.com/questions/29245216/write-in-shared-volumes-docker puede que se hayan acabado los problemas de los permisos
RUN usermod -u 1000 www-data
RUN usermod -G staff www-data

#PROD ADD app/ /var/www/html/