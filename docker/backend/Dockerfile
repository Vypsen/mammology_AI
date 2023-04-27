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
    docker-php-ext-install gd && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    # Clear cache
    apt-get clean && rm -rf /var/lib/apt/lists/*

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

#COPY . .

RUN #chown -R www-data:www-data /var/www/mammology && \
#    chmod -R 775 /var/www/mammology/storage && \
#    chmod -R 775 /var/www/mammology/bootstrap/cache \


EXPOSE 9000

RUN #composer install

CMD ["php-fpm"]
