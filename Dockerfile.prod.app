# Build Stage 0
# Run tests
FROM composer:2.1.9 AS stage0
RUN apk add --no-cache libzip-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libpng-dev

RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd


WORKDIR /var/www
COPY ./src/ /var/www/

# Rename test env file production
RUN mv .env.test .env

RUN composer install --ignore-platform-reqs --no-interaction --prefer-dist --optimize-autoloader
RUN ./vendor/phpunit/phpunit/phpunit tests/Unit/ --testdox --verbose && ./vendor/phpunit/phpunit/phpunit tests/Feature/Http/Controllers/ --testdox --verbose
RUN rm -f .env && rm -rf vendor && rm -rf tests && rm -f .phpunit.result.cache && rm -f phpunit.xml


# Build Stage 1
# Compile composer dependencies
FROM composer:2.1.9 AS stage1
WORKDIR /var/www
COPY --from=stage0 /var/www /var/www/
RUN composer install --ignore-platform-reqs --no-interaction --no-dev --prefer-dist --optimize-autoloader


# Build Stage 2
# Compile NPM assets
FROM node:12-alpine AS stage2
WORKDIR /var/www
COPY --from=stage1 /var/www /var/www
RUN rm -rf public/css && rm -rf public/js && rm -rf public/img
RUN npm install npm -g
RUN npm install
RUN npm run production
RUN rm -rf node_modules


# Build Stage 3
# PHP-FPM
FROM php:7.4.24-fpm

WORKDIR /var/www

# Install dependencies
RUN apt-get update -y && apt-get update --fix-missing && apt-get install pkg-config
RUN export PKG_CONFIG_PATH=/usr/lib/pkgconfig
RUN apt-get install build-essential libpng-dev libjpeg62-turbo-dev libfreetype6-dev locales zip jpegoptim optipng pngquant gifsicle vim unzip curl git libpq-dev openssl libssl-dev libcurl4-openssl-dev libonig-dev libxml2 libxml2-dev libzip-dev -y

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install extensions
RUN docker-php-ext-install pdo pdo_pgsql pdo_mysql bcmath ctype tokenizer curl mbstring xml zip
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install -j$(nproc) gd

# Configs
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"
COPY ./php/local.ini /usr/local/etc/php/conf.d/local.ini

# Copy project files
COPY --from=stage2 /var/www /var/www
COPY ./docker-entrypoint-prod.sh /var/www/docker-entrypoint-prod.sh

# Move env file production
RUN mv .env.prod .env

RUN chmod +x ./docker-entrypoint-prod.sh

# Delete directories unnecessary
RUN rm -rf html && rm -rf php && rm -rf nginx

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN chown -R www:www /var/www
USER www

EXPOSE 9000

ENTRYPOINT ["./docker-entrypoint-prod.sh"]

