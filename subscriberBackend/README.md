## Specifications

- PHP 7.2 or greater
- Laravel 7
- Bootstrap

## Developer Notes

Please follow these instructions to set up your development environment:

- Rename .env.example to .env
- composer update
- sudo chmod -R 0777 storage
- Set db user name & password in .env ( DB_USERNAME & DB_PASSWORD )
- php artisan make:database
- php artisan key:generate
- php artisan migrate
- php artisan config:cache
- php artisan serve
