<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProjectController;


/* Nur mit Login erreichbar - Nach Authentifizierung */
Route::middleware('auth')->group(function() {

    Route::resource('state', StateController::class);

    Route::resource('project', ProjectController::class);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Kundenverwaltung */
    Route::get('customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('addCompany', [CustomerController::class, 'addCompany'])->name('addCompany');
    Route::post('addCustomer', [CustomerController::class, 'addCustomer'])->name('addCustomer');

    Route::post('modalEditCustomer', [CustomerController::class, 'modalEditCustomer'])->name('modalEditCustomer');
    Route::post('editCustomer', [CustomerController::class, 'editCustomer'])->name('editCustomer');

    Route::post('modalEditCompany', [CustomerController::class, 'modalEditCompany'])->name('modalEditCompany');
    Route::post('editCompany', [CustomerController::class, 'editCompany'])->name('editCompany');

});

/* Öffentliche Links */
Route::get('/', function () {
    return view('auth.login');
});

require __DIR__.'/auth.php';
