<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\TerapiaController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\EsercizioController;
use App\Http\Controllers\EpisodioController;
use App\Http\Controllers\SigninUtente;
use App\Models\Paziente;


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

Route::middleware('auth:sanctum')->any('/checkToken', function (Request $request) {
    return "hai un token";
});


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('medico',MedicoController::class);
    Route::resource('terapia',TerapiaController::class);
    Route::resource('paziente',PazienteController::class);
    Route::resource('esercizio',EsercizioController::class);
    Route::resource('episodio',EpisodioController::class);
});



//Route::post('/login', [SigninUtente::class, 'login']);


/**
* Middleware api serve per evitare il controllo su cross-site scripting
* Si configura in http/Kernel.php
*/
Route::middleware('api')->group(function () {
    /**
    * Routes that require session data
    */
    Route::post('/login', function (Request $request, Response $response) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
     
        $paziente = Paziente::where('email', $request->email)->first();
     
        if (! $paziente || ! password_verify($request->password, $paziente->password)) {
            return $response;
        }

        $token = $paziente->createToken('paziente_token');
        return ['token' => $token->plainTextToken];
    })->name('login');
});
