<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'LoginPage'])->name('login');

Route::post('/login', [AuthController::class, 'check'])->name('login.check');

Route::get('/register', [AuthController::class, 'RegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'store'])->name('register.store');

Route::resource('/pets', PetController::class)->middleware('auth');
