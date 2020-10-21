FROM php:7.3-apache

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    git \
&& pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& docker-php-ext-install pdo_mysql

COPY ./apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www