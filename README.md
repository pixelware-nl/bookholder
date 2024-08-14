# Bookholder.nl

Bookholder is an easy-to-use SaaS focussed on providing accountant services to people freelancers and startups.
In this document we will discuss how to set up the project as wel as the technologies that are being used.

## Stack
The project is written in PHP and TypeScript using the Laravel en and Vue frameworks respectively. 
For the backend we make use of PHP Laravel and PHPUnit for the unit testing.
Due to the scale of the project and ability to grow it is important to create a maintainable project throughout.

The frontend is written in Typescript using Vue.js and Inertia to connect it back to PHP Laravel.
For the flow we use UI tests, and write unit tests for composables using JEST.

The database is a simple SQLite database with intention to migrate to MySQL in the future.

## Requirements
- Operating systems
  - Windows
  - MacOS
  - Linux
- Tools
  - Node
  - Composer
  - PHP

Keep in mind to only push to `master` if there are no bugs in the unit tests and flow. 
If it does have bugs and/or breaking unit test we use the `develop` branch.

## Installation
First make sure **composer** is installed on your computer, as wel as **node**

Then run the following commands to set up your local environment
```bash
composer install
```
``` 
npm install
```
When migrating the database for the first time we need to run `php artisan migrate` so that we can create the SQLite database.
```bash
php artisan migrate
```
Then we can seed it by rerunning the migration command using `--seed`.
```bash
php artisan migrate:fresh --seed
```

## Set up the ENV
Create the `.env` file locally.
```bash
cp .env.example .env
```
Generate the key
```bash
php artisan key:generate
```

## Running the application
To run the application you need to run the following two commands at the same time.

Note, when `php artisan serve` is done with its initial set up it shows you a localhost URL, use that
```bash
php artisan serve
```
```bash 
vite
```

Use the following command to run the `PHPUnit` unit tests.
```bash
vendor/bin/phpunit
```

## Login
You can now log into the test environment using the following account details
```text
username: test@pixelware.nl 
password: secret!2024
```

---
That is all, happy programming!

Authored by Okan can Ozbek, August 13th 2024.

v0.2.2
