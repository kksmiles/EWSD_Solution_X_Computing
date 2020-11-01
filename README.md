# EWSD_Solution_X_Computing
## About the application
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
 
## Project Resources Link 
Program live testing on Heroku Server : http://ewsd-solutionx.herokuapp.com/  
Link for screencast : https://drive.google.com/file/d/1S6tLYMrKYeVMxIZQQoYxUUjmJq1SZDB6/view?usp=sharing  
Link for presentation slide : https://drive.google.com/file/d/1D4VhoFIWc_IE7AY9O6TXB1spBE7ILPRM/view?usp=sharing  
