<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeController::class)->name('home')->middleware('auth');

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', [AuthController::class,'login'])->name('login');
    Route::post('/sign_in', 'signIn')->name('sign_in');
});