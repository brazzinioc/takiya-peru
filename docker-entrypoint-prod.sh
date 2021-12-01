#!/bin/sh

# Key
php artisan key:generate

# Cache
php artisan route:cache --quiet
#php artisan config:cache --quiet

# link to storage
php artisan storage:link


# Migrations
php artisan migrate --force

php-fpm
