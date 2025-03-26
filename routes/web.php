<?php

use Illuminate\Support\Facades\Route;

// controllers

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\TestController;
use App\Http\Controllers\Site\IndexController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Site\PlaylistsController;
use App\Http\Controllers\Site\PerformerController;
use App\Http\Controllers\Admin\DiscographyController;
use App\Http\Controllers\Admin\PerformersController;
use App\Http\Controllers\Admin\SongsController;
use App\Http\Controllers\Admin\MedalController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/test', [TestController::class, 'test'])->name("test");

Route::get('/index', [IndexController::class, 'index'])->name("index");


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('admin')->group(function () {
        Route::get('genres', [GenreController::class, 'index'])->name("genres");
        Route::get('genreCreate', [GenreController::class, 'create'])->name("genreCreate");
        Route::post('genreStore', [GenreController::class, 'store'])->name("genreStore");
        Route::get('genreDelete', [GenreController::class, 'remove'])->name("generDelete");
        Route::get('genreEdit', [GenreController::class, 'edit'])->name("genreEdit");
        Route::post('genreUpdate', [GenreController::class, 'update'])->name("genreUpdate");

        Route::get('discography', [DiscographyController::class, 'index'])->name("discography");
        Route::get('diskCreate', [DiscographyController::class, 'create'])->name("diskCreate");
        Route::post('diskStore', [DiscographyController::class, 'store'])->name("diskStore");
        Route::get('diskDelete', [DiscographyController::class, 'remove'])->name("diskDelete");
        Route::get('diskEdit', [DiscographyController::class, 'edit'])->name("diskEdit");
        Route::post('diskUpdate', [DiscographyController::class, 'update'])->name("diskUpdate");


        Route::get('performers', [PerformersController::class, 'index'])->name("performers");
        Route::get('performerCreate', [PerformersController::class, 'create'])->name("performerCreate");
        Route::post('performerStore', [PerformersController::class, 'store'])->name("performerStore");
        Route::get('performerDelete', [PerformersController::class, 'remove'])->name("performerDelete");
        Route::get('performerEdit', [PerformersController::class, 'edit'])->name("performerEdit");
        Route::post('performerUpdate', [PerformersController::class, 'update'])->name("performerUpdate");

        Route::get('songs', [SongsController::class, 'index'])->name("songs");
        Route::get('songCreate', [SongsController::class, 'create'])->name("songCreate");
        Route::post('songStore', [SongsController::class, 'store'])->name("songStore");
        Route::get('songDelete', [SongsController::class, 'remove'])->name("songDelete");
        Route::get('songEdit', [SongsController::class, 'edit'])->name("songEdit");
        Route::post('songUpdate', [SongsController::class, 'update'])->name("songUpdate");

        Route::get('medals', [MedalController::class, 'index'])->name("medals");
        Route::get('medalCreate', [MedalController::class, 'create'])->name("medalCreate");
        Route::post('medalStore', [MedalController::class, 'store'])->name("medalStore");
        Route::get('medalDelete', [MedalController::class, 'remove'])->name("medalDelete");
        Route::get('medalEdit', [MedalController::class, 'edit'])->name("medalEdit");
        Route::post('medalUpdate', [MedalController::class, 'update'])->name("medalUpdate");
    });
});
require __DIR__ . '/auth.php';
