## Installation

Mit der Powershell in den htdoc Ordner von XAMPP navigieren

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

## Models erstellen
- php artisan make:model States
- php artisan make:model Companies
- php artisan make:model Customers
- php artisan make:model Projects 

## Models definieren
- protected $table
- protected $fillable

## Ressourcen Controller erstellen und im web.php definieren
[Laravel Doc Resource Controller](https://laravel.com/docs/9.x/controllers#resource-controllers)
- php artisan make:controller StatesController --resource
- Funktionen index & store erstellt

## View & Route
- routes/web.php: Route zum Ressourcen Controller definiert
- views/resources: neuer Ordner states & neues File: index.blade.php