FROM php:8.4-cli

RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    sqlite3 \
    libsqlite3-dev

RUN docker-php-ext-install zip pdo pdo_mysql pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
