# EWSD_Solution_X_Computing
Coursework Repository for Final Year Bsc.(Hons) Computing.<br>
COMP 1640 - Enterprise Web Software Development
 
## How to start project for Development or Testing Purposes
 The project is developed using Laravel framework version 7.24 
 > Note : Requires php version 7.2 and composer
 > Database : Mysql <br>
 - Download the repository.
 - Open the repository with your operating system terminal
 - Change directory to `ewsd_web` folder
 - Run the command `composer install` in the folder to download the required framework dependencies
 - Rename `.env.example` to `.env`
 - Set the `DB` values in the `.env` file to your database configurations.
 - Run the command `php artisan key:generate` to generate application key needed.
 - Run the command `php artisan migrate:fresh` to create database tables needed.
 - Run the command `php artisan serve` to start development.
 - The application can be visited on `127.0.0.1:8000` or `localhost:8000` on your browser. 
