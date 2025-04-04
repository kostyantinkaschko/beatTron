<?php

use Illuminate\Support\Facades\Route;

// controllers

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\GeneralController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\NewsController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\MedalController;
use App\Http\Controllers\Admin\SongsController;

use App\Http\Controllers\Site\PlaylistController;
use App\Http\Controllers\Site\GenreSiteController;
use App\Http\Controllers\Admin\PerformersController;
use App\Http\Controllers\Admin\DiscographyController;
use App\Http\Controllers\Site\PerformerSiteController;

Route::get('/', [GeneralController::class, 'index']);
Route::get('general', [GeneralController::class, 'index'])->name("general");


Route::prefix('site')->middleware(['site'])->group(function () {
    Route::get('news', [NewsController::class, 'site'])->name("news");
    Route::get('playlists', [PlaylistController::class, 'site'])->name("playlists");
    Route::get('genresSite', [GenreSiteController::class, 'site'])->name("genresSite");
    Route::get('performersSite', [PerformerSiteController::class, 'site'])->name("performersSite");
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::prefix('admin')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('genres', [GenreController::class, 'index'])->name("genres");
    Route::get('genreCreate', [GenreController::class, 'create'])->name("genreCreate");
    Route::post('genreStore', [GenreController::class, 'store'])->name("genreStore");
    Route::delete('genreDelete/{id}', [GenreController::class, 'remove'])->name("genreDelete");
    Route::patch('genreRestore/{id}', [GenreController::class, 'restore'])->name("genreRestore");
    Route::get('genreEdit/{id}', [GenreController::class, 'edit'])->name("genreEdit");
    Route::post('genreUpdate/{id}', [GenreController::class, 'update'])->name("genreUpdate");

    Route::get('discography', [DiscographyController::class, 'index'])->name("discography");
    Route::get('diskCreate', [DiscographyController::class, 'create'])->name("diskCreate");
    Route::post('diskStore', [DiscographyController::class, 'store'])->name("diskStore");
    Route::delete('diskDelete/{id}', [DiscographyController::class, 'remove'])->name("diskDelete");
    Route::patch('diskRestore/{id}', [DiscographyController::class, 'restore'])->name("diskRestore");
    Route::get('diskEdit/{id}', [DiscographyController::class, 'edit'])->name("diskEdit");
    Route::post('diskUpdate/{disk}', [DiscographyController::class, 'update'])->name("diskUpdate");


    Route::get('performers', [PerformersController::class, 'index'])->name("performers");
    Route::get('performerCreate', [PerformersController::class, 'create'])->name("performerCreate");
    Route::post('performerStore', [PerformersController::class, 'store'])->name("performerStore");
    Route::delete('performerDelete/{id}', [PerformersController::class, 'remove'])->name("performerDelete");
    Route::patch('performerRestore/{id}', [PerformersController::class, 'restore'])->name("performerRestore");
    Route::get('performerEdit/{id}', [PerformersController::class, 'edit'])->name("performerEdit");
    Route::post('performerUpdate/{id}', [PerformersController::class, 'update'])->name("performerUpdate");

    Route::get('songs', [SongsController::class, 'index'])->name("songs");
    Route::get('songCreate', [SongsController::class, 'create'])->name("songCreate");
    Route::post('songStore', [SongsController::class, 'store'])->name("songStore");
    Route::delete('songDelete/{id}', [SongsController::class, 'remove'])->name("songDelete");
    Route::patch('songRestore/{id}', [SongsController::class, 'restore'])->name("songRestore");
    Route::get('songEdit/{id}', [SongsController::class, 'edit'])->name("songEdit");
    Route::post('songUpdate/{id}', [SongsController::class, 'update'])->name("songUpdate");

    Route::get('medals', [MedalController::class, 'index'])->name("medals");
    Route::get('medalCreate', [MedalController::class, 'create'])->name("medalCreate");
    Route::post('medalStore', [MedalController::class, 'store'])->name("medalStore");
    Route::delete('medalDelete/{id}', [MedalController::class, 'remove'])->name("medalDelete");
    Route::patch('medalRestore/{id}', [MedalController::class, 'restore'])->name("medalRestore");
    Route::get('medalEdit/{id}', [MedalController::class, 'edit'])->name("medalEdit");
    Route::post('medalUpdate/{id}', [MedalController::class, 'update'])->name("medalUpdate");

    Route::get('users', [UserController::class, 'index'])->name("users");
    Route::delete('userDelete/{id}', [UserController::class, 'remove'])->name("userDelete");
    Route::patch('userRestore/{id}', [UserController::class, 'restore'])->name("userRestore");
    Route::get('userEdit/{id}', [UserController::class, 'edit'])->name("userEdit");
    Route::post('userUpdate/{id}', [UserController::class, 'update'])->name("userUpdate");
});

require __DIR__ . '/auth.php';
