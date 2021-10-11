
# Getting started

## Installation

Clone project in your localhost www or htdocs 
Clone the repository

    git clone git@github.com:gothinkster/simple-pharmacy.git

create database with proper name


Switch to the repo folder

    cd simple-pharmacy

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

   
# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api
    
# Docker

For Docker usage you can use docker sail move project to your wsl path then run sail
open terminal in project path (ubuntu distro)

       ./vendor/bin/sail up
then open localhost       
    
