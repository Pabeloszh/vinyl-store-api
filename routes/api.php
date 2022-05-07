<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VinylController;
use App\Http\Controllers\GenreController;

Route::get('/vinyls', [VinylController::class, 'index']);
Route::post('/vinyls', [VinylController::class, 'store']);

Route::get('/vinyls/{id}', [VinylController::class, 'show']);
Route::put('/vinyls/{id}', [VinylController::class, 'update']);
Route::delete('/vinyls/{id}', [VinylController::class, 'destroy']);

Route::get('/genres', [GenreController::class, 'index']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
