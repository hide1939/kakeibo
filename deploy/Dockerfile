FROM php:7.3-apache

# apache
COPY ./deploy/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./deploy/apache/apache2.conf /etc/apache2/apache2.conf

WORKDIR /var/www/kakeibo

# copy kakeibo-app to container
COPY ./kakeibo .