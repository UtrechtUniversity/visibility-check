# This is a production version of the Dockerfile
# This Dockerfile has two steps
# 1. Build: collect oll composer dependencies
# 2. Create the apache container that serves the backend and copy the dependency and the app code to this container

FROM composer:2.5.8 as vendor

WORKDIR /app

# Copy database classes required by laravel
COPY database/ database/

# Copy composers files
COPY composer.json composer.json
COPY composer.lock composer.lock

# Get dependencies this will also generate the autoload
RUN composer install \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --no-dev \
    --prefer-dist

# Backend container: PHP 8.2 with Apache for Laravel
FROM php:v8.2-apache

# Update container dependencies
RUN apt-get upgrade && apt-get update
RUN apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libmcrypt-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd

# Configure Apache
COPY ./docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite


# Copy code
COPY . /var/www/html/
#Copy vendor folder
COPY --from=vendor /app/vendor/ /var/www/html/vendor/


