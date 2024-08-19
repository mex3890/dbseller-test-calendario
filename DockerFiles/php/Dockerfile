FROM php:5.6-fpm-alpine

RUN apk update && apk add --no-cache \
    postgresql-dev \
    libzip-dev \
    libxml2-dev \
    curl

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo \
  pdo_pgsql \
  pgsql \
  zip \
  bcmath \
  json \
  mbstring \
  xml \
  xmlrpc
