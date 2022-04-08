<?php

use App\Http\Controllers\AccueilController;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\PraticienController;
use App\Http\Controllers\RapportsDeVisite;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth'])->group(function (){

    // Page accueil
    Route::get('/', [AccueilController::class, 'accueil'])
        ->name('accueil');

    // Page rapport (Route page / Route save new rapport)
    Route::get('/rapport-de-visite', [RapportsDeVisite::class, 'rapportDeVisite'])
        ->name('rapportDeVisite');
    Route::get('/rapport-de-visite/delete/{id}', [RapportsDeVisite::class, 'destroy'])
        ->name('rapportDeVisite.destroy');
    Route::get('/rapport-de-visite/pdf/{id}', [RapportsDeVisite::class, 'pdf'])
        ->name('rapportDeVisite.pdf');
    Route::post('/rapport-de-visite', [RapportsDeVisite::class, 'store'])
        ->name('rapportDeVisite.store');

    // Page Praticiens (Route page / Route Ajax request)
    Route::get('/praticiens', [PraticienController::class, 'praticiens'])
        ->name('praticiens');
    Route::post('/praticiens', [PraticienController::class, 'store'])
        ->name('requestPraticien.store');

    // Page Compte
    Route::get('/compte', [CompteController::class, 'account'])
        ->name('account');
    Route::post('/compte', [CompteController::class, 'update'])
        ->name('account.update');

    

});

require __DIR__.'/auth.php';

