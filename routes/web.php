<?php

use App\Http\Controllers\v1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/verify-email/{id}/{token}', [AuthController::class, 'verifyEmail'])->name('auth.verify.email');
