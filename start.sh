#!/bin/sh

# Run migrations
php artisan migrate --force

# Seed the admin user
php artisan db:seed --class=AdminUserSeeder --force

# Start Apache
exec apache2-foreground
