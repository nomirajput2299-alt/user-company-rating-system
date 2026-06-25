<?php

use App\Http\Controllers\Backend\Admin\Company\AdminCompanyController;
use App\Http\Controllers\Backend\Auth\AdminAuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\User\Comapny\UserCompanyController;
use App\Http\Controllers\Frontend\AboutUs\AboutUsController;
use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\ContactUs\ContactUsController;
use App\Http\Controllers\Frontend\WebHomeController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/')->group(function () {
    // Landing Page
    Route::get('/', [WebHomeController::class, 'index'])->name('web.home');

    Route::get('/about-us', [AboutUsController::class, 'index'])->name('web.aboutUs.index');

    /*
    |--------------------------------------------------------------------------
    | ContactUs Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/contact-us')->group(function () {
        Route::get('/', [ContactUsController::class, 'create'])->name('web.contactUs.create');
        Route::post('/store', [ContactUsController::class, 'store'])->name('web.contactUs.store');
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
Route::middleware(['auth', 'user.status'])->prefix('/back-end')->group(function () {
    /*
    |--------------------------------------------------------------------------
    | Dashboard Routes
    |--------------------------------------------------------------------------
    */
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('backend.dashboard.index');
    });

    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->prefix('/admin')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | User Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('/users')->group(function () {
            Route::get('/index', [AdminAuthController::class, 'index'])->name('admin.user.index');
            Route::get('/view/{userId}', [AdminAuthController::class, 'view'])->name('admin.user.view');
            Route::get('/create', [AdminAuthController::class, 'create'])->name('admin.user.create');
            Route::post('/store', [AdminAuthController::class, 'store'])->name('admin.user.store');
            Route::get('/edit/{userId}', [AdminAuthController::class, 'edit'])->name('admin.user.edit');
            Route::put('/update', [AdminAuthController::class, 'update'])->name('admin.user.update');
            Route::post('/toggle-status/{userId}', [AdminAuthController::class, 'toggleStatus'])->name('admin.user.toggleStatus');
            Route::put('/change-role', [AdminAuthController::class, 'changeRole'])->name('admin.user.changeRole');
            Route::delete('/delete/{userId}', [AdminAuthController::class, 'delete'])->name('admin.user.delete');
        });

        /*
        |--------------------------------------------------------------------------
        | Company Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('/company')->group(function () {
            Route::get('/index', [AdminCompanyController::class, 'index'])->name('admin.company.index');
            Route::get('/view/{companyId}', [AdminCompanyController::class, 'view'])->name('admin.company.view');
            Route::get('/create', [AdminCompanyController::class, 'create'])->name('admin.company.create');
            Route::post('/store', [AdminCompanyController::class, 'store'])->name('admin.company.store');
            Route::get('/edit/{companyId}', [AdminCompanyController::class, 'edit'])->name('admin.company.edit');
            Route::put('/update', [AdminCompanyController::class, 'update'])->name('admin.company.update');
            Route::post('/toggle-status/{companyId}', [AdminCompanyController::class, 'toggleStatus'])->name('admin.company.toggleStatus');
            Route::delete('/delete/{companyId}', [AdminCompanyController::class, 'delete'])->name('admin.company.delete');
        });
    });

    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:user'])->prefix('/user')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Company Routes
        |--------------------------------------------------------------------------
        */
        Route::prefix('/company')->group(function () {
            Route::get('/index', [UserCompanyController::class, 'index'])->name('user.company.index');
            Route::get('/view/{companyId}', [UserCompanyController::class, 'view'])->name('user.company.view');
            Route::get('/create', [UserCompanyController::class, 'create'])->name('user.company.create');
            Route::post('/store', [UserCompanyController::class, 'store'])->name('user.company.store');
            Route::get('/edit/{companyId}', [UserCompanyController::class, 'edit'])->name('user.company.edit');
            Route::put('/update', [UserCompanyController::class, 'update'])->name('user.company.update');
            Route::post('/toggle-status/{companyId}', [UserCompanyController::class, 'toggleStatus'])->name('user.company.toggleStatus');
            Route::delete('/delete/{companyId}', [UserCompanyController::class, 'delete'])->name('user.company.delete');
        });
    });
});


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
