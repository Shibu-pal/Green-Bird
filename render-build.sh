#!/usr/bin/env bash

echo "🚀 Running Render build script"

# Ensure correct permissions
chmod -R 775 storage bootstrap/cache

# Install PHP dependencies
composer install --no-dev --optimize-autoloader

# Set up Laravel
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set app key (only needed once or when APP_KEY is not set)
php artisan key:generate --force

# Run DB migrations
php artisan migrate --force

echo "✅ Laravel build complete"
