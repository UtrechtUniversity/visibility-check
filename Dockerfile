# This is a multistage build:
# note the "as build" that is used to reference the node container
# when creating the apache container with "--from=build"

FROM node:16.3-alpine  as build
WORKDIR /app
ENV PATH /app/node_modules/.bin:$PATH
COPY package.json ./
COPY package-lock.json ./
RUN npm ci
COPY . ./
RUN npm run build


FROM php:7.4-apache-bullseye

ARG PORT=8080

# Configure Apache
COPY docker/apache.conf /etc/apache2/sites-enabled/000-default.conf
RUN sed -i "s/^Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf && \
    a2enmod rewrite 

EXPOSE ${PORT}

# Copy the react build
COPY --from=build /app/build/ /var/www/html/visibilitycheck/docs/

RUN chgrp -R 0 /var/www/html/visibilitycheck/docs && \
    chmod -R g=u /var/www/html/visibilitycheck/docs
