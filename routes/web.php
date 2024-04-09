<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CookieController;
use App\Http\Controllers\CoursController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationsController;
use App\Http\Controllers\ServicesController;
use App\Models\Accueil;
use App\Models\Cour;
use App\Models\EchangeCompetence;
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
    Route::get("/creerSondage",[AccueilController::class,'createSondageVue'])->name('create-sondage');
    Route::get("/create-sondage",[AccueilController::class,'createSondage'])->name('create-sondageBDD');


    Route::get('/cookie', [CookieController::class,'index'])->name('pageCookie');
    Route::post('/cookie/click', [CookieController::class,'click'])->name('addCookie');
    Route::post('/cookie/trade', [CookieController::class,'echangeCookieMonnaie'])->name('tradeCookie');


    Route::post('/evenementService/reserver', [ServicesController::class,'registerService'])->name('reserverService');


    Route::get("/ValidationServices/{idService}",[ServicesController::class,'getInfoPourValidation'])->name("infoValidation");

    Route::get("/informationReservation/{idReservation}",[ReservationsController::class,'getInfoReservation'])->name("infoReservation");
    Route::get("/listeReservations",[ReservationsController::class,'getAllReservationByUser'])->name('getReservations');
    Route::post('/annulerReservation',[ReservationsController::class,'annulerReservation'])->name("annulerReservation");

});

require __DIR__.'/auth.php';
