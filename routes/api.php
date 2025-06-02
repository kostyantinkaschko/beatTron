<?php

use App\Http\Controllers\Api\PerformersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Api\SongsController;

Route::prefix('v1')
    ->group(function () {
        Route::apiResource('songs', SongsController::class);
        Route::apiResource('performers', PerformersController::class);
    });
