
# Backend container: PHP 8.2 with Apache for Laravel
FROM php:8.2-apache


# Configure Apache
COPY ./docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN a2enmod rewrite

