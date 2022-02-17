## Installation

Mit der Powershell in den htdoc Ordner von 

- composer create-project laravel/laravel kundenverwaltung
- cd kundenverwaltung
- composer require barryvdh/laravel-debugbar --dev
- composer require laravel/breeze --dev
- php artisan breeze:install

## Datenbank
- PHP MyAdmin Datenbank erstellen
- im .env File Datenbankverbindung hinterlegen

## Migrationen
- php artisan make:migration create_states_table
- php artisan make:migration create_companies_table
- php artisan make:migration create_customers_table
- php artisan make:migration create_projects_table

## Datenbank einspielen
- php artisan migrate

