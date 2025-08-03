#!/bin/bash

# Set proper permissions
chmod -R 777 storage 2>/dev/null || true
chmod -R 777 bootstrap/cache 2>/dev/null || true

# Create storage directories if they don't exist
mkdir -p storage/framework/sessions
mkdir -p storage/framework/views
mkdir -p storage/framework/cache

# Clear any cached config
php artisan config:clear
php artisan cache:clear
php artisan view:clear

# Generate application key if not set
if [ -z "$APP_KEY" ] || [ "$APP_KEY" = "base64:YOUR_GENERATED_KEY" ]; then
    php artisan key:generate --force
fi

# Start Laravel application
php artisan serve --host=0.0.0.0 --port=$PORT
