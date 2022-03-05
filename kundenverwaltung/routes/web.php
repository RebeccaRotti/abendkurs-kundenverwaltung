<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CustomerController;


/* Nur mit Login erreichbar - Nach Authentifizierung */
Route::middleware('auth')->group(function() {

    Route::resource('state', StateController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Kundenverwaltung */
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('addCompany', [CustomerController::class, 'addCompany'])->name('addCompany');
    Route::post('addCustomer', [CustomerController::class, 'addCustomer'])->name('addCustomer');

});

/* Öffentliche Links */
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
