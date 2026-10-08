FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN docker-php-ext-install zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer