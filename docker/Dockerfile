FROM php:7.1-apache

MAINTAINER Jakub Fajkus <jakub.fajkus@gmail.com>

COPY . /var/www/html/

RUN docker-php-ext-install pdo_mysql

EXPOSE 80

#ENTRYPOINT ["sh", "docker/entrypoint.sh"]