#!/usr/bin/env bash
set -e

echo "🔧 Setting permissions..."
chmod -R 775 storage bootstrap/cache

echo "📦 Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "⚙️ Running Laravel setup..."
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "🔑 Generating app key (if not set)..."
php artisan key:generate || true

echo "🗄️ Running database migrations..."
php artisan migrate --force

echo "✅ Build script finished!"
