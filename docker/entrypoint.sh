#!/bin/bash

if [ ! -f ".env" ]; then
    echo "creating env file."
    cp .env.example .env
else
    echo "env file already exists"
fi

composer install -q --no-ansi --no-interaction --no-scripts --no-progress --prefer-dist

chmod -R 777 storage bootstrap/cache
php artisan migrate --seed
php artisan key:generate
php artisan cache:clear
php artisan config:clear
php artisan route:clear

php artisan serve --port=$PORT --host=0.0.0.0 --env=.env
exec docker-php-entrypoint "$@"