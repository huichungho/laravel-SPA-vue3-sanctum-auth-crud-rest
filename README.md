# Customer Onboard System

## features
SPA with vueJS  
RESTful CRUD  
API Authentication using Laravel Sanctum  

## environment
PHP 8.0.4RC1 (cli)  
Laravel Framework 8.33.1  
MySQL 5.7.24  

## configure database
CREATE USER 'customer_mgr'@'localhost' IDENTIFIED BY 'customer_mgr_pwd';  
CREATE DATABASE 'customer';  
GRANT ALL PRIVILEGES ON customer.* TO 'customer_mgr'@'localhost';  

## .env
DB_CONNECTION=mysql  
DB_HOST=127.0.0.1  
DB_PORT=3306  
DB_DATABASE=YOUR_DATABASE  
DB_USERNAME=YOUR_USERNAME  
DB_PASSWORD=YOUR_PASSWORD  

## clear cache
php artisan optimize && php artisan config:clear

## database migration
php artisan migrate:fresh --seed

## deploy development server
php -S localhost:8000 -t public

<img src="../master/screenshots/portal-about.JPG" width="60%">
