# Event Explorer HK
https://eventexplorerhk.store/

## Getting Start
Make sure you have installed the followings:
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

## Production deployment procedure
1. Open Github Desktop
2. Click Fetch origin
3. Click `Repository` > `Open in Visual Studio Code `
4. Update `.env` , reference from `.env.example`
    - production value
5. On VS Code, Click `Terminal` > `New Terminal`
6. Run command `composer install`
7. Run command `php artisan migrate--seed`
    - Enter `yes` for run this command
8. Run command `npm install`
9. Run command `npm run build`
