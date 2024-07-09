#!/bin/sh

# Install composer dependencies
#composer install
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
chmod -R 775 /var/www/storage /var/www/bootstrap/cache

php artisan key:generate
# Run database migrations
#php artisan migrate

# Start PHP-FPM
php-fpm
