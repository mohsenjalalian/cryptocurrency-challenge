About
--------

A currency system with a base currency
* a job for update currency prices
* you can order an exchange
* you can track your order

## Installation

* git clone project

* run docker-compose up -d in the root dir

* update your /etc/hosts and add back.crypto domain or change 
vhost domain in docker/crypto-nginx/vhosts.d

* run docker-compose exec crypto-php-cli bash

* copy .env.example and make your env file

* run composer install

* run chown -R www-data:www-data /src/storage

* run php artisan migrate in /src dir

* run php artisan db:seed --class=CurrencySeeder

* run php artisan update:currency-prices

* import postman collection file from docs dir
