<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Umum (Semua User)
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->where('movie', '[0-9]+')->name('movies.show');
    Route::post('/movies/{movie}/review', [MovieController::class, 'storeReview'])->name('movies.review.store');

    // Rute Khusus Admin (CRUD Lengkap)
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    // Rute Edit & Update (BARU)
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    
    // Rute Delete (BARU)
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';