FROM php:7.3-apache

# apache
COPY ./deploy/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./deploy/apache/apache2.conf /etc/apache2/apache2.conf

# healthcheck for load balancer
COPY ./deploy/healthcheck/ /var/www/healthcheck

# php
COPY ./deploy/php/php.ini /usr/local/etc/php/php.ini

# extension
RUN apt-get update && apt-get install -y \
    vim \
&& docker-php-ext-install pdo_mysql

WORKDIR /var/www/kakeibo

# copy kakeibo-app to container
COPY ./kakeibo .