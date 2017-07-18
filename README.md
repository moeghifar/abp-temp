# ABP-temp
Currently the official home of ABP Accounting project. From previous version ABP-Accounting, now I change the name to ABP-temp. I dont know, I just want it to be changed. Created for research purpose.

# Pre-requisite
1. [MySql](https://mysql.com) or [MariaDB](https://mariadb.org) Database 
2. [Composer](https://getcomposer.org/)
3. [Laravel Framework 5.4](https://laravel.com/docs/5.4/) - laravel may require another dependencies

# Installation
> New and fresh install apps for the first time
1. clone this repository to your local environment
2. run ` composer install ` to install apps dependencies
3. configure .env file, create it by copying from .env.example with command ```cp .env.example .env```
4. run `php artisan key:generate` to generate key
5. run `php artisan migrate` to create tables in database
6. run `php artisan db:seed` to insert pre-generated data
7. ready to serve! `php artisan serve`

# Update
> Update means you would like to upgrade app release version
1. run `composer install` to update dependencies
2. run `php artisan migrate:reset` to reset tables in database
3. run `php artisan migrate` to re-create tables in database
4. run `php artisan db:seed` to insert pre-generated data
5. ready to serve! `php artisan serve`

# About
<p align="left">
    <img src="https://laravel.com/assets/img/components/logo-laravel.svg">
</p>

- Laravel 5.4 Framework
- PHP 5.6.30
- MariaDB / MySQL Database
- Jquery

# Contact
reach ghi.fai@gmail.com
