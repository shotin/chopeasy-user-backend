<?php

use App\Http\Controllers\v1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/verify-email/{id}/{token}', [AuthController::class, 'verifyEmail'])->name('auth.verify.email');

// Add login route for authentication middleware
Route::get('/login', function() {
    return response()->json(['message' => 'Login endpoint is at /api/v1/auth/login'], 401);
})->name('login');
