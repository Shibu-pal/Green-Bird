#!/usr/bin/env bash

# Set permissions
chmod -R 775 storage bootstrap/cache

# Install dependencies
composer install --no-dev --optimize-autoloader

# Generate app key
php artisan key:generate

# Run database migrations
php artisan migrate --force
