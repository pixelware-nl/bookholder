#!/usr/bin/env sh

php artisan key:generate --no-interaction

if [ "$APP_ENV" != 'prod' ]; then

    php artisan ide-helper:generate
    php artisan ide-helper:meta
fi

composer install
php artisan migrate

if [ "$APP_ENV" = 'prod' ]; then
    nginx -g 'daemon off;' & php-fpm -F
else
    php-fpm
fi
