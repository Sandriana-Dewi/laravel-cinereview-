<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovieController;
use App\Models\User;
use App\Models\Review;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard dengan Logika Statistik
Route::get('/dashboard', function () {
    // Data Statistik Admin
    $totalMovies = Movie::count();
    $totalUsers = User::where('role', 'user')->count();
    $totalReviews = Review::count();

    // --- PERBAIKAN ERROR MERAH DI SINI ---
    /** @var \App\Models\User $user */
    $user = Auth::user(); 
    // Kita simpan user ke variabel $user dan kasih tahu VS Code kalau ini adalah Model User kita

    // Data Riwayat User (Sekarang pakai variabel $user, bukan Auth::user() langsung)
    $myReviews = $user->reviews()->with('movie')->latest()->take(5)->get();
    $myReviewCount = $user->reviews()->count();

    return view('dashboard', compact('totalMovies', 'totalUsers', 'totalReviews', 'myReviews', 'myReviewCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Rute Film
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/search', [MovieController::class, 'search'])->name('movies.search');
    Route::get('/movies/{movie}', [MovieController::class, 'show'])->where('movie', '[0-9]+')->name('movies.show');
    Route::post('/movies/{movie}/review', [MovieController::class, 'storeReview'])->name('movies.review.store');

    // Rute Admin
    Route::get('/movies/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movies', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movies/{movie}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movies/{movie}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movies/{movie}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';