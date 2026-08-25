<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'homeIndex'])->name('welcome');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/register', [RegisterController::class, 'Register'])->name('register');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'editProfil'])->name('profil.edit');
    Route::patch('/profil', [ProfilController::class, 'updateProfil'])->name('profil.update');
});

