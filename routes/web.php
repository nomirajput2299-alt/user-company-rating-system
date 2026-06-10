<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\WebHomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Home Frontend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Home Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/')->group(function () {
        Route::get('/', [WebHomeController::class, 'index'])->name('Web.Home');
    });

    /*
    |--------------------------------------------------------------------------
    | Auth Routes
    |--------------------------------------------------------------------------
    */
   Route::prefix('auth')->group(function () {
    // Guest Routes
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('web.auth.showLogin');
        Route::post('/login', [AuthController::class, 'login'])->name('web.auth.login');
        Route::get('/sign-up', [AuthController::class, 'showSignup'])->name('web.auth.showSignup');
        Route::post('/sign-up', [AuthController::class, 'signup'])->name('web.auth.signup');
    });
    // Authenticated Route
    Route::middleware('auth')->group(function () {
        Route::post('/log-out', [AuthController::class, 'logout'])->name('web.auth.logout');
    });
});
});

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('/back-end')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard.index');
    });
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
