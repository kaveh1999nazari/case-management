FROM php:8.3-cli

RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \
    libzip-dev \
    libpq-dev

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN docker-php-ext-install pdo_pgsql pgsql mbstring

WORKDIR /app

COPY . /app

RUN composer install

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8084"]

EXPOSE 8084

