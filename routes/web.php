<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonctionController;
use App\Http\Controllers\ServiceController;

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
    Route::get('/fonctions', [FonctionController::class, 'index'])->name('fonctions.index');
    Route::post('/fonctions', [FonctionController::class, 'store'])->name('fonctions.store');
    Route::get('/fonctions/{id}', [FonctionController::class, 'show'])->name('fonctions.show');
    Route::put('/fonctions/{id}', [FonctionController::class, 'update'])->name('fonctions.update');
    Route::delete('/fonctions/{id}', [FonctionController::class, 'destroy'])->name('fonctions.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{id}', [ServiceController::class, 'show'])->name('services.show');
    Route::put('/services/{id}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');
});

require __DIR__.'/auth.php';
