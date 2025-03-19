<?php

use Illuminate\Support\Facades\Route;

// controllers

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\TestController;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Site\GenresController;
use App\Http\Controllers\Site\PlaylistsController;
use App\Http\Controllers\Site\PerformerController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', [TestController::class, 'test'])->name("test");

Route::get('/index', [IndexController::class, 'index'])->name("index");

Route::get('/genres', [GenresController::class, 'genres'])->name("genres");

Route::get('/playlists', [PlaylistsController::class, 'playlists'])->name("playlists");

Route::get('/performer', [PerformerController::class, 'performer'])->name("performer");
        
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
