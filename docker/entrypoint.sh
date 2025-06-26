#!/bin/sh

# roda o comando direto
php artisan storage:link || true

# inicia 
exec php-fpm
