#!/usr/bin/env bash
echo "Render is running"
# Set permissions
chmod -R 775 storage bootstrap/cache

# Install dependencies
composer install --no-dev --optimize-autoloader

php artisan config:cache
php artisan route:cache
php artisan view:cache

# Generate app key
php artisan key:generate

# Run database migrations
php artisan migrate --force

echo "running completed"