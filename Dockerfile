FROM php:8.4.8RC1-fpm-alpine3.21 AS backend

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    curl \
    unzip \
    git \
    libzip-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev && \
    docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . /var/www/html
COPY --chown=www-data:www-data . /var/www/html

COPY --chmod=755 .docker/entrypoint.sh /entrypoint.sh

# Then set user after copying files
USER www-data

EXPOSE 9000
ENTRYPOINT ["/entrypoint.sh"]






