<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Models\ACCUEIL;
use App\Models\COUR;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */
Route::get('/dashboard', [AccueilController::class, 'get_donnees_accueil'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile',[ProfileController::class, 'logout'])->name('profile.logout');

    Route::get('/cours', [CoursController::class, 'get_data_cours'])->name('cours');
    Route::get('/covoiturage', [ProfileController::class, 'covoiturage'])->name('covoiturage');
    Route::get('/evenements', [EventController::class, 'get_evenement'])->name('evenements');
    Route::get('/services', [ServicesController::class, 'services'])->name('services');
    Route::get('/espace_pro', [ProfileController::class, 'espace_pro'])->name('espace_pro');

    Route::post('/vote/pour/{idSondage}', [AccueilController::class, 'votePour'])->name('vote.pour');
    Route::post('/vote/contre/{idSondage}', [AccueilController::class, 'voteContre'])->name('vote.contre');
});

require __DIR__.'/auth.php';
