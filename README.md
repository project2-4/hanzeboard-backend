# Hanzeboard backend

## Prerequisites
- PHP >= 7.1
    - [Install macOS](http://php.net/manual/en/install.macosx.php)
    - [Install windows](http://php.net/manual/en/install.windows.php)
- Composer
    - [Install composer](https://getcomposer.org/download/)
- Npm
    - [Install npm](https://www.npmjs.com/get-npm)

## Installation
```bash
composer install
cp ./.env.example ./.env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan jwt:secret
```

## Setting up IDE helper (PhpStorm)
* Laravel IDE helper
    * [docs](https://github.com/barryvdh/laravel-ide-helper)
    * Automatic phpDoc generation for Laravel Facades
        * `php artisan ide-helper:generate`
