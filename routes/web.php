<?php

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminCityController;
use App\Http\Controllers\Admin\AdminDealerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/',HomeController::class)->name('home')->middleware('auth');

Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/sign_in', 'signIn')->name('sign_in');
    Route::get('/logout', 'logout')->name('logout');
});

Route::controller(AdminLoginController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/sign_in', 'signIn')->name('sign_in');
});

Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    Route::controller(AdminBaseController::class)->group(function () {
        Route::get('/', 'home')->name('home');
    });

    Route::controller(AdminUsersController::class)->group(function () {
        Route::get('/users/{slug?}', 'users')->name('users');
        Route::post('/edit-user', 'editUser')->name('edit_user');
        Route::post('/delete-user', 'deleteUser')->name('delete_user');
    });

    Route::controller(AdminCityController::class)->group(function () {
        Route::get('/cities/{slug?}', 'cities')->name('cities');
        Route::post('/edit-city', 'editCity')->name('edit_city');
        Route::post('/delete-city', 'deleteCity')->name('delete_city');
    });

    Route::controller(AdminDealerController::class)->group(function () {
        Route::get('/dealers/{slug?}', 'dealers')->name('dealers');
        Route::post('/edit-dealer', 'editDealer')->name('edit_dealer');
        Route::post('/delete-dealer', 'deleteDealer')->name('delete_dealer');
    });
});