<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\PostController;
use App\Http\Controllers\Api\v1\TagController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['api'])->group(function () {
    Route::prefix('v1')->group(function () {
        Route::middleware(['add.content.language.header', 'localization'])->group(function () {
            Route::apiResource('posts', PostController::class);
        });
        Route::apiResource('tags', TagController::class);
    });
});
