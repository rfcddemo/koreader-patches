<?php

use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\CategorieInvestisseurController;
use App\Http\Controllers\InvestorController;
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
// Routes pour les catégories d'investisseurs
    Route::resource('categories-investisseurs', CategorieInvestisseurController::class)
        ->middleware([
            'can:viewAny,App\Models\CategorieInvestisseur',
            'can:create,App\Models\CategorieInvestisseur',
            'can:update,App\Models\CategorieInvestisseur',
            'can:delete,App\Models\CategorieInvestisseur'
        ]);

    Route::post('/categories-investisseurs/reorder', [CategorieInvestisseurController::class, 'reorder'])
        ->name('categories-investisseurs.reorder')
        ->middleware('can:reorder,App\Models\CategorieInvestisseur');

    Route::get('/investisseurs', [InvestorController::class, 'index'])
        ->name('investors.index')
        ->middleware('can:viewAny,App\Models\Investor');
        ;

    Route::get('/investisseurs/create', [InvestorController::class, 'create'])
        ->name('investors.create')
        ->middleware('can:create,App\Models\Investor');
    Route::post('/investisseurs', [InvestorController::class, 'store'])
        ->name('investors.store')
        ->middleware('can:create,App\Models\Investor');

    Route::get('/investisseurs/{investor}', [InvestorController::class, 'show'])
        ->name('investors.show')
        ->middleware('can:view,investor');
    Route::get('/investisseurs/{investor}/edit', [InvestorController::class, 'edit'])
        ->name('investors.edit')
        ->middleware('can:update,investor');

    Route::patch('/investisseurs/{investor}', [InvestorController::class, 'update'])
        ->name('investors.update')
        ->middleware('can:update,investor');

    Route::delete('/investisseurs/{investor}', [InvestorController::class, 'destroy'])
        ->name('investors.destroy')
        ->middleware('can:delete,investor');

    Route::get('/investisseurs/{investor}/timeline', [InvestorController::class, 'timeline'])
        ->name('investors.timeline')
        ->middleware('can:view,investor');

    Route::get('/investisseurs/{investor}/export', [InvestorController::class, 'export'])
        ->name('investors.export')
        ->middleware('can:view,investor');

    Route::get('/investisseurs/{investor}/export-pdf', [InvestorController::class, 'exportPdf'])
        ->name('investors.export-pdf')
        ->middleware('can:view,investor');



    // Routes AJAX pour les commentaires d'investisseurs
    Route::prefix('ajax')->name('ajax.')->group(function () {
        Route::post('/investors/{investor}/comments', [App\Http\Controllers\Ajax\InvestorCommentController::class, 'store'])
            ->name('investor.comments.store')
            ->middleware('can:view,investor');

        Route::get('/investors/{investor}/comments', [App\Http\Controllers\Ajax\InvestorCommentController::class, 'index'])
            ->name('investor.comments.index')
            ->middleware('can:view,investor');

        Route::patch('/comments/{comment}', [App\Http\Controllers\Ajax\InvestorCommentController::class, 'update'])
            ->name('comments.update');

        Route::delete('/comments/{comment}', [App\Http\Controllers\Ajax\InvestorCommentController::class, 'destroy'])
            ->name('comments.destroy');

        // Routes pour les interactions
        Route::post('/investors/{investor}/interactions', [App\Http\Controllers\Ajax\InteractionController::class, 'store'])
            ->name('investor.interactions.store')
            ->middleware('can:view,investor');

        Route::get('/investors/{investor}/interactions', [App\Http\Controllers\Ajax\InteractionController::class, 'index'])
            ->name('investor.interactions.index')
            ->middleware('can:view,investor');
    });

});

require __DIR__.'/auth.php';
