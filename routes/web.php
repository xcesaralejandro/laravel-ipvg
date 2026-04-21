<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'LoginPage'])->name('auth.login');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('auth.register');
