<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\FoglalasokFizetesekController;
use App\Http\Controllers\NyelvController;
use App\Http\Controllers\TeremController;
use App\Http\Controllers\VetitesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


Route::get('/nyelvek', [NyelvController::class, 'index']);
Route::get('/filmek', [FilmController::class, 'index']);
Route::get('/filmek/{id}', [FilmController::class, 'show']);
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

Route::get('/vetites/{id}', [VetitesController::class, 'show']);
Route::post('/foglalas', [FoglalasokFizetesekController::class, 'store']);
//NEM KELL: Route::post('/admin/login', [AdminController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    // Itt lesznek a vedett routeok. 
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/filmek', [FilmController::class, 'store']);
Route::middleware('auth:sanctum')->post('/vetites', [VetitesController::class, 'store']);
Route::middleware(['auth:sanctum'])->group(function () {
    Route::delete('/filmek/{id}', [FilmController::class, 'destroy']);
    Route::put('/filmek/{id}', [FilmController::class, 'update']);
    Route::middleware(['auth:sanctum', 'App\Http\Middleware\CheckSuperAdmin'])->post('/admin/new-user', [AdminController::class, 'createAdmin']);
    Route::post('/vetitesek/{vetites_id}/eladas', [FoglalasokFizetesekController::class, 'eladas']);
    Route::get('/foglalasok-fizetesek', [FoglalasokFizetesekController::class, 'index']);
    Route::patch('/foglalasok-fizetesek/{id}/fizet', [FoglalasokFizetesekController::class, 'fizetesVegrehajtasa']);
});

?>
