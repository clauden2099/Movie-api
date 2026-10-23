<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\HealthContoller;
use Illuminate\Support\Facades\Route;

// Es /api/health
Route::get('/health', HealthContoller::class);
// Api resource de generos
Route::apiResource('genres', GenreController::class);
