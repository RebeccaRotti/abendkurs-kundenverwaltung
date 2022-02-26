<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Nur mit Login erreichbar - Nach Authentifizierung */
Route::middleware('auth')->group(function() {

    Route::resource('state', StateController::class);
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});

/* Öffentliche Links */
Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/auth.php';
