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
FROM php:v8.2-apache.55
ARG PORT=8080

# Configure Apache
COPY ../docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN sed -i "s/^Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    a2enmod rewrite
EXPOSE ${PORT}

# Copy code
COPY . /var/www/html/
#Copy vendor folder
COPY --from=vendor /app/vendor/ /var/www/html/vendor/

# Environment variables
ENV APP_NAME=vcadmin
ENV DB_CONNECTION=mysql
ENV DB_PORT=3306
ENV CACHE_DRIVER=apc
ENV SESSION_DRIVER=apc
ENV CACHE_PATH=/opt/vcadmin/cache
ENV LOG_CHANNEL=stderr
