<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\CategorieInvestisseurController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les organisations - sans middleware global can:view
    Route::resource('organisations', OrganisationController::class);

    // Routes additionnelles pour les organisations
    Route::get('/organisations/{organisation}/logo', [OrganisationController::class, 'downloadLogo'])
        ->name('organisations.logo')
        ->middleware('can:view,organisation');

    Route::post('/organisations/{organisation}/toggle-status', [OrganisationController::class, 'toggleStatus'])
        ->name('organisations.toggle-status')
        ->middleware('can:update,organisation');

    // Routes pour les catégories d'investisseurs
    Route::resource('categories-investisseurs', CategorieInvestisseurController::class);
    Route::post('/categories-investisseurs/reorder', [CategorieInvestisseurController::class, 'reorder'])
        ->name('categories-investisseurs.reorder');
});

require __DIR__.'/auth.php';
