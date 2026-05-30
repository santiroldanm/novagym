<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;












Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('public')->group(function () {
    Route::get('/clients', [\App\Http\Controllers\Api\PublicApiController::class, 'clients']);
    Route::get('/routines', [\App\Http\Controllers\Api\PublicApiController::class, 'routines']);
    Route::get('/instructors', [\App\Http\Controllers\Api\PublicApiController::class, 'instructors']);
});
