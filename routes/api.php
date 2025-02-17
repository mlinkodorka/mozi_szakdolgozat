<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FoglalasokFizetesekController;
use App\Http\Controllers\NyelvController;
use App\Http\Controllers\TeremController;
use App\Http\Controllers\VetitesController;
use Illuminate\Support\Facades\Route;

Route::get('/nyelvek', [NyelvController::class, 'index']);
Route::get('/filmek', [FilmController::class, 'index']);
Route::get('/foglalas_fizetes', [FoglalasokFizetesekController::class, 'index']);
Route::get('/vetites', [VetitesController::class, 'index']);
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/terem', [TeremController::class, 'index']);

Route::get('/filmek/nyelv/{nyelvkod}', [FilmController::class, 'filmekNyelvSzerint']);
Route::get('/vetites/terem/{terem_id}', [VetitesController::class, 'vetitesekTeremSzerint']);
Route::get('/filmek/ev/{ev}', [FilmController::class, 'filmekEvSzerint']);
Route::get('/vetites/{vetites_id}/szabad_helyek', [VetitesController::class, 'szabadHelyek']);

Route::get('/foglalasok/szam/vetites', [FoglalasokFizetesekController::class, 'foglalasokVetitesSzerint']);
Route::get('/admin/abc', [AdminController::class, 'adminListaABC']);
Route::get('/vetitesek/idoszak/{start}/{end}', [VetitesController::class, 'vetitesekIdoszakban']);
Route::get('/vetites/legnepszerubb', [VetitesController::class, 'legnepszerubbVetites']);
Route::get('/nyelvek/hasznalt', [NyelvController::class, 'hasznaltNyelvek']);
Route::get('/vetitesek/szam/terem', [VetitesController::class, 'vetitesekSzamaTeremSzerint']);

?>
