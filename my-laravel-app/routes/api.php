<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    // 購入API
    Route::post('/purchase', [ProductController::class, 'purchase']);
});

// ログインAPI
Route::post('/login', [AuthController::class, 'login']);
