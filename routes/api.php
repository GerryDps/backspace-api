<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\TerapiaController;
use App\Http\Controllers\PazienteController;
use App\Http\Controllers\EsercizioController;
use App\Http\Controllers\EpisodioController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('medico',MedicoController::class);
Route::resource('terapia',TerapiaController::class);
Route::resource('paziente',PazienteController::class);
Route::resource('esercizio',EsercizioController::class);
Route::resource('episodio',EpisodioController::class);
