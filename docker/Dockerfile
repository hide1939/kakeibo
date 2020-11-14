FROM node:14.15.0-buster as node
FROM php:7.3-apache

# composer install
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# node npm install
COPY --from=node /usr/local/bin/ /usr/local/bin/
COPY --from=node /usr/local/lib/node_modules /usr/local/lib/node_modules

COPY ./php/php.ini /usr/local/etc/php/php.ini

COPY ./apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY ./apache/apache2.conf /etc/apache2/apache2.conf

RUN apt-get update && apt-get install -y \
    git \
    libfreetype6-dev \
    libjpeg-dev \
    libpng-dev \
    unzip \
    vim \
    zip \
&& git clone https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
&& pecl install xdebug \
&& docker-php-ext-enable xdebug \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install gd pdo_mysql redis \
&& a2enmod rewrite