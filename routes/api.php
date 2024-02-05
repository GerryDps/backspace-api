<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\TerapiaController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\EsercizioController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\UtenteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum','api'])->any('/checkToken', function (Request $request) {
    return "hai un token";
});


/**
 * Le risorse qui sono protette da autenticazione
 * header={'Authorization': 'Bearer TOKEN'}
 */
Route::middleware(['auth:sanctum','api'])->group(function () {
    Route::resource('medico',MedicoController::class);
    Route::resource('terapia',TerapiaController::class);
    Route::resource('paziente',PazienteController::class);
    Route::resource('esercizio',EsercizioController::class);
    Route::resource('episodio',EpisodioController::class);
});


/**
* Middleware api serve per evitare il controllo su cross-site scripting
* Si configura in http/Kernel.php
*/
Route::middleware('api')->group(function () {
    /**
    * Routes that require session data
    */

    //UtenteController->register()
    Route::post('/register', [UtenteController::class, 'register'])->name('register');

    //UtenteController->login()
    Route::post('/login', [UtenteController::class, 'login'])->name('login');

    //UtenteController->forgotpassword()
    Route::post('/forgot-password', [UtenteController::class,'forgotpassword'])->name('forgotpassword');

    //UtenteController->resetpassword()
    Route::post('/reset-password', [UtenteController::class,'resetpassword'])->name('resetpassword');
});
