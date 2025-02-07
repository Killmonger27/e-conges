<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FonctionController;

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

require __DIR__.'/auth.php';
