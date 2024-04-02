<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServicesController;
use App\Models\ACCUEIL;
use App\Models\COUR;
use App\Models\ECHANGECOMPETENCE;
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

Route::get('/', [AccueilController::class, 'get_donnees_accueil'])->middleware(['auth', 'verified'])->name('dashboard');


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
    Route::post('/services', [ServicesController::class, 'new'])->name('services.new');
    Route::get('/services_ajax', [ServicesController::class, 'dataList'])->name('services.datalist');
    Route::get('/espace_pro', [ProfileController::class, 'espace_pro'])->name('espace_pro');

    Route::post('/vote/pour/{idSondage}', [AccueilController::class, 'votePour'])->name('vote.pour');
    Route::post('/vote/contre/{idSondage}', [AccueilController::class, 'voteContre'])->name('vote.contre');

    Route::get('/cookie', [CookieController::class,'index'])->name('pageCookie');
    Route::post('/cookie/click', [CookieController::class,'click'])->name('addCookie');
    Route::post('/cookie/trade', [CookieController::class,'echangeCookieMonnaie'])->name('tradeCookie');


    Route::post('/evenementCinema/reserver', [ServicesController::class,'registerService'])->name('reserverCinema');
    Route::post('/evenementSport/reserver', [ServicesController::class,'reserverSport'])->name('reserverSport');
    Route::post('/echangeCompet/reserver', [ServicesController::class,'reserverEchangeCompet'])->name('reserverEchangeCompet');
    Route::post('/evenementConvoit/reserver', [ServicesController::class,'reserverConvoit'])->name('reserverConvoit');
    Route::post('/evenementLoisir/reserver', [ServicesController::class,'registerService'])->name('reserverLoisir');


});

require __DIR__.'/auth.php';
