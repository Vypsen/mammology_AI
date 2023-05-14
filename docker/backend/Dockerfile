FROM php:8.0-fpm

WORKDIR /var/www/mammology

RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    libonig-dev \
    zip \
    libzip-dev \
    libpq-dev \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl && \
    pecl install xdebug-3.0.1 && \
    docker-php-ext-enable xdebug && \
    docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin \

USER root
EXPOSE 9000
CMD ["sh", "-c", "npm install && npm run watch"]
CMD ["php-fpm"]
