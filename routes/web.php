<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'homeIndex'])->name('welcome');

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])
    ->middleware('throttle:login')
    ->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/clear-rate-limit-session', [LoginController::class, 'rateLimiting'])->name('clear.rate.limit');

Route::post('/register', [RegisterController::class, 'Register'])
    ->middleware('throttle:register')
    ->name('register');
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register/verify-email', [RegisterController::class, 'verifyEmail'])
    ->middleware('throttle:verify-code')
    ->name('register.verify.email');
Route::post('/register/cancel', [RegisterController::class, 'cancelRegistration'])->name('register.cancel');

Route::get('/notifications', [NotificationController::class, 'showNotifications'])->name('notifications.feed');

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfilController::class, 'editProfil'])->name('profil.edit');
    Route::patch('/profil', [ProfilController::class, 'updateProfil'])->name('profil.update');

    Route::post('/profil/email/request', [ProfilController::class, 'requestEmailChange'])
        ->middleware('throttle:email-change')
        ->name('profil.email.request');
    Route::post('/profil/email/verify', [ProfilController::class, 'verifyEmailChanges'])
        ->middleware('throttle:verify-code')
        ->name('profil.email.verify');
    Route::post('/profil/email/cancel', [ProfilController::class, 'cancelEmailChange'])->name('profil.email.cancel');
    Route::get('/profil/email/oauth/{provider}', [ProfilController::class, 'redirectEmailChange'])->name('profil.email.oauth.redirect');

    Route::post('/profil/locale', [ProfilController::class, 'updateLocale'])->name('profil.locale.update');

    Route::post('/profil/theme', [ProfilController::class, 'updateTheme'])->name('profil.theme.update');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::patch('/posts/{post:uuid}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post:uuid}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::patch('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.password.update');
