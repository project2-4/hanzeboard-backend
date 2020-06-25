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
```

## JWT key pair
When running this server in a production a fresh RS256 key-pair needs to be generated for security purposes. 
By running `./genRS256.sh` a new key pair will be generated automatically. 

## Database
![dbdiagram](https://github.com/project2-4/hanzeboard-backend/blob/database/.docs/dbdiagram.png?raw=true)

## Websockets
For handeling websockets the Laravel Websockets package is used [https://github.com/beyondcode/laravel-websockets](https://github.com/beyondcode/laravel-websockets). 
This package is a drop-in Pusher replacement by making their api a completely match with Pusher's. 
As a result Laravels build-in Pusher drivers can be used even though we are running a local socket server.

### Configuration
Even though we do not really use Pusher, all the `PUSHER_` environment variables well need to be defined because [https://github.com/beyondcode/laravel-websockets](Laravel Websockets) will uses these variables.

The [https://github.com/beyondcode/laravel-websockets](Laravel Websockets) documentation states the following about the required value for these variables:<br>
_It does not matter what you set as your `PUSHER_` variables. Just make sure they are unique for each project._

### Generating keys
The value of the keys does not matter so we could just generate a random string:
```bash
php artisan tinker 
```

```
# Psy Shell v0.10.4 (PHP 7.4.0 — cli) by Justin Hileman
>>> Str::random(64)
```

## Setting up IDE helper
* Laravel IDE helper (PhpStorm)
    * [docs](https://github.com/barryvdh/laravel-ide-helper)
        * `php artisan ide-helper:generate`
        * `php artisan ide-helper:meta`
