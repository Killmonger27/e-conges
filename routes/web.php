<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DemandeController;
use Illuminate\Auth\Middleware\Authorize;

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

Route::middleware(['auth','can:gerer_fonctions'])->group(function () {
    Route::get('fonctions/{id}/edit', [FonctionController::class, 'edit'])->name('fonctions.edit');
    Route::get('fonctions/create', [FonctionController::class, 'create'])->name('fonctions.create');
    Route::get('/fonctions', [FonctionController::class, 'index'])->name('fonctions.index');
    Route::post('/fonctions', [FonctionController::class, 'store'])->name('fonctions.store');
    Route::get('/fonctions/{id}', [FonctionController::class, 'show'])->name('fonctions.show');
    Route::put('/fonctions/{id}', [FonctionController::class, 'update'])->name('fonctions.update');
    Route::delete('/fonctions/{id}', [FonctionController::class, 'destroy'])->name('fonctions.destroy');
});

Route::middleware('auth','can:gerer_services')->group(function () {
    Route::get('services/{id}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

Route::middleware('auth','can:gerer_employes')->group(function () {
    Route::get('/employes/edit/{id}', [UserController::class, 'edit'])->name('employes.edit');
    Route::get('/employes/create', [UserController::class, 'create'])->name('employes.create');
    Route::post('/employes', [UserController::class, 'store'])->name('employes.store');
    Route::put('/employes/{id}', [UserController::class, 'update'])->name('employes.update');
    Route::delete('/employes/{id}', [UserController::class, 'destroy'])->name('employes.destroy');
});

Route::middleware('auth')->group(function () {

    Route::get('/employes', [UserController::class, 'index'])->name('employes.index');
    
    Route::get('/employes/{id}', [UserController::class, 'show'])->name('employes.show');
    
});

Route::middleware('auth')->group(function () {
    Route::get('/demandes', [DemandeController::class, 'index'])->name('demandes.index');
    Route::get('/demandes/create', [DemandeController::class, 'create'])->name('demandes.create');
    Route::get('/demandes/{id}', [DemandeController::class, 'show'])->name('demandes.show');
    Route::post('/demandes', [DemandeController::class, 'store'])->name('demandes.store');
    Route::delete('/demandes/{id}', [DemandeController::class, 'destroy'])->name('demandes.destroy');

   

    // Afficher le formulaire d'édition pour le GRH
    Route::get('/demandes/{id}/edit', [DemandeController::class, 'grhEdit'])->name('grh.edit');
    // Traiter la soumission du formulaire d'édition pour le GRH
    Route::put('/demandes/{id}', [DemandeController::class, 'grhUpdate'])->name('grh.update');


    // Route pour approuver une demande
    Route::post('/demandes/{demande}/approve', [DemandeController::class, 'approve'])->name('demandes.approve');

    // Route pour rejeter une demande
    Route::post('/demandes/{demande}/reject', [DemandeController::class, 'reject'])->name('demandes.reject');

    Route::get('/brouillons', [DemandeController::class, 'brouillons'])->name('demandes.brouillons');
    // Afficher le formulaire d'édition d'une demande au brouillon
    Route::get('/brouillons/{demande}/edit', [DemandeController::class, 'editBrouillon'])->name('demandes.edit_brouillon');

    // Supprimer une demande au brouillon
    Route::delete('/brouillons/{demande}', [DemandeController::class, 'destroyBrouillon'])->name('demandes.destroy_brouillon');

    Route::get('/brouillons/{demande}', [DemandeController::class, 'showBrouillon'])->name('demandes.show_brouillon');
    // Mettre à jour une demande au brouillon
    Route::put('/brouillons/{demande}', [DemandeController::class, 'updateBrouillon'])->name('demandes.update_brouillon');
    // Envoyer une demande au brouillon
    Route::post('/brouillons/{demande}/send', [DemandeController::class, 'sendBrouillon'])->name('demandes.send_brouillon');


});

Route::middleware('auth')->group(function () {
    Route::get('/mesdemandes', [DemandeController::class, 'mesDemandes'])->name('mesdemandes.index');
    Route::get('/mesdemandes/create', [DemandeController::class, 'create'])->name('mesdemandes.create');
    Route::get('/mesdemandes/{id}', [DemandeController::class, 'showMesDemandes'])->name('mesdemandes.show');
    Route::post('/mesdemandes', [DemandeController::class, 'store'])->name('mesdemandes.store');
});

require __DIR__.'/auth.php';
