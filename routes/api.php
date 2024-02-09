<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompletatoController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\EsercizioController;
use App\Http\Controllers\EsercizioTerapiaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\PazienteTerapiaController;
use App\Http\Controllers\QuestionarioController;
use App\Http\Controllers\TerapiaController;
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

// questa funzione necessita di essere autenticato
Route::middleware(['auth:sanctum','api'])->any('/checkToken', function (Request $request) {
    return ['TOKEN'=> $request->user()->currentAccessToken(), 'PAZIENTE'=>$request->user()];
});


/**
 * Le risorse qui sono protette da autenticazione
 * header={'Authorization': 'Bearer TOKEN'}
 */
Route::middleware(['auth:sanctum','api'])->group(function () {
    /**
     * Just the logout route protetta da sanctum
     */
    Route::post('/logout', [UtenteController::class, 'logout'])->name('logout');

    /**
     * Risorse, crea le route alle crud per ogni risorsa
     */
    Route::resource('medico',MedicoController::class);
    Route::resource('terapia',TerapiaController::class);
    Route::resource('paziente',PazienteController::class);
    Route::resource('esercizio',EsercizioController::class);
    Route::resource('episodio',EpisodioController::class);
    
    Route::resource('pazienteterapia',PazienteTerapiaController::class);
    Route::resource('completato',CompletatoController::class);
    Route::resource('esercizioterapia',EsercizioTerapiaController::class);
    Route::resource('questionario',QuestionarioController::class);


});


/**
* Middleware api serve per evitare il controllo su cross-site scripting
* Si configura in http/Kernel.php
*/
Route::middleware('api')->group(function () {
    /**
    * Routes that require session data ma nessuna autorizzazione
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
