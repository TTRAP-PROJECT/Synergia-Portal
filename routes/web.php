<?php

use App\Http\Controllers\ProfileController;
use App\Models\ACCUEIL;
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
Route::get('/dashboard', [ACCUEIL::class, 'get_api_donnees_accueil'])->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/cours', [ProfileController::class, 'cours'])->name('cours');
    Route::get('/covoiturage', [ProfileController::class, 'covoiturage'])->name('covoiturage');
    Route::get('/evenements', [ProfileController::class, 'evenements'])->name('evenements');
    Route::get('/espace_pro', [ProfileController::class, 'espace_pro'])->name('espace_pro');
});

require __DIR__.'/auth.php';
