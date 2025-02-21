#!/bin/sh
set -e

TARGET_PATH="/var/www/shared/store_app/public"

mkdir -p $TARGET_PATH

cp -r /var/www/store_app/public/* $TARGET_PATH/
php artisan migrate && php artisan config:cache && php artisan route:cache
chown -R www-data:www-data ./database/sqlite

exec "$@"
