<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Halaman awal langsung arahkan ke Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard (Halaman setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- GRUP RUTE KHUSUS MEMBER (Harus Login) ---
Route::middleware('auth')->group(function () {
    
    // 1. Menampilkan Daftar Film
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    
    // 2. Halaman Form Tambah Film
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    
    // 3. Proses Simpan Data Film (POST)
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    
    // 4. Fitur Pencarian AJAX
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');

    // Rute Profil (Bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Memuat rute autentikasi bawaan (login, register, dll)
require __DIR__.'/auth.php';