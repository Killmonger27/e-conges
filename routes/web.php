<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth','can:voir_employes','can:gerer_employes')->group(function () {

    Route::get('/employes', [UserController::class, 'index'])->name('employes.index');
    
    Route::get('/employes/{id}', [UserController::class, 'show'])->name('employes.show');
    
});
require __DIR__.'/auth.php';
