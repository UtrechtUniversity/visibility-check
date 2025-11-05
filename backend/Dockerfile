
# Backend container: PHP 8.2 with Apache for Laravel
FROM php:8.2-apache

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

#RUN pecl install mcrypt && docker-php-ext-enable mcrypt

# Configure Apache
COPY ./docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite

# Configure Laravel
RUN php artisan key:generate --force


