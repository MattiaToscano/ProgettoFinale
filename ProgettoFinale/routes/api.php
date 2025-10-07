<?php

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Support\Facades\Route;

// Lista film
Route::get('/films', function () {
    $films = Film::with('genres')->get();
    foreach ($films as $film) {
        $film->poster_url = $film->poster_path ? asset('storage/' . $film->poster_path) : null;
    }
    return response()->json($films)->header('Access-Control-Allow-Origin', '*');
});

// Singolo film
Route::get('/films/{id}', function ($id) {
    $film = Film::with('genres')->find($id);
    $film->poster_url = $film->poster_path ? asset('storage/' . $film->poster_path) : null;
    return response()->json($film)->header('Access-Control-Allow-Origin', '*');
});

// Lista generi
Route::get('/genres', function () {
    return response()->json(Genre::all())->header('Access-Control-Allow-Origin', '*');
});







