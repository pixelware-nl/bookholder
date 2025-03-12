#!/usr/bin/env sh

if [ "$APP_ENV" != 'prod' ]; then
    composer install
    php artisan ide-helper:generate
    php artisan ide-helper:meta
fi

php artisan migrate

if [ "$APP_ENV" = 'prod' ]; then
    nginx -g 'daemon off;' & php-fpm -F
else
    php-fpm
fi
