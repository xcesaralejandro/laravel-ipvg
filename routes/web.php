<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'LoginPage'])->name('auth.login');
Route::get('/register', [AuthController::class, 'RegisterPage'])->name('auth.register');

Route::get('/pets', [PetController::class, 'index'])->name('pet.index');
