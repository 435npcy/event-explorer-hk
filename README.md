# Event Explorer HK

## Production deployment procedure
1. Open Github Desktop
2. Click Fetch origin
3. Click `Repository` > `Open in Visual Studio Code `
4. Update `.env` , reference from `.env.example`
    - production value
5. On VS Code, Click `Terminal` > `New Terminal`
6. Run command `composer install`
7. Run command `php artisan migrate`
    - Enter `yes` for run this command
8. (Optional) Run other commands if needed
    - e.g. `php artisan db:seed --class=EventSeeder`
9. Run command `npm install`
10. Run command `npm run build`

## Requirements

-   PHP >= 8.1
-   Laravel >= 10
-   Node >= 14.21

## Installation

For MacOS

-   Install [Homebrew](https://brew.sh/)
-   Install [PHP]
    -   Execute cmd, `brew install php`
-   Install [Composer](https://getcomposer.org/)
    -   Execute cmd, `brew install composer`
-   Install [NVM](https://github.com/nvm-sh/nvm)
    -   (optional) Execute cmd, `npm install 18`
-   Install [Docker](https://docs.docker.com/desktop/install/mac-install/)

For Windows

-   Install [XAMPP](https://www.apachefriends.org/)
-   Install [Composer](https://getcomposer.org/)
-   Install [NVM](https://github.com/coreybutler/nvm-windows)
-   Install [Docker](https://docs.docker.com/desktop/install/windows-install/)

## Before you start

-   Go to this project and open terminal. you should in this project directory
-   And you need three terminals

### Terminal 1

1. Execute cmd, `cp .env.example .env` or create `.env` file from `.env.example`
2. Update config values in `.env` file
   2.1 Update `DB_PASSWORD` value, e.g. example
3. Execute cmd, `composer install`
4. Execute cmd, `php artisan key:generate``

### Terminal 2

1. Execute cmd,

    - `docker-compose up` <- if you want to run in foreground
    - `docker-compose up -d` <- if you want to run in background

### Terminal 3

1. Execute cmd, `npm install`

## Before you start

-   Go to this project and open terminal. you should in this project directory

### Terminal 1

1. Execute cmd, `php artisan migrate --seed`
2. Execute cmd, `php artisan serve`

### Terminal 2

1. Execute cmd, `npm run dev`