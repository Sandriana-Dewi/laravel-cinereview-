<?php

use Illuminate\Support\Facades\Route;
use App\Models\Movie;

// Endpoint API Movies
Route::get('/movies', function () {
    return response()->json([
        'status' => 'success',
        'data' => Movie::all()
    ]);
});