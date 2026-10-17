<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Support\Facades\Route;

// Public routes (no login required)
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/products', [ProductController::class, 'index']);

// Protected routes (must be logged in with a token)
Route::middleware('auth:sanctum')->group(function () {
    // We will add cart, checkout, and order routes here later
});