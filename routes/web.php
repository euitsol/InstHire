<?php

use App\Http\Controllers\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Login Routes
Route::controller(AdminLoginController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginCheck')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});

// Admin Dashboard Routes
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::group(['as' => 'am.', 'prefix' => 'admin-management'], function () {
        Route::resource('admin', AdminController::class);
        Route::get('admin/status/{admin}', [AdminController::class, 'status'])->name('admin.status');
    });
});

// Institute Routes
Route::prefix('institute')->name('institute.')->group(function () {
    Route::middleware('guest:institute')->group(function () {
        Route::get('login', [App\Http\Controllers\Institute\Auth\LoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [App\Http\Controllers\Institute\Auth\LoginController::class, 'login'])->name('login.submit');
        Route::get('register', [App\Http\Controllers\Institute\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [App\Http\Controllers\Institute\Auth\RegisterController::class, 'register'])->name('register.submit');
    });

    Route::middleware('auth:institute')->group(function () {
        Route::get('dashboard', [App\Http\Controllers\Institute\InstituteController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [App\Http\Controllers\Institute\InstituteController::class, 'profile'])->name('profile');
        Route::put('profile', [App\Http\Controllers\Institute\InstituteController::class, 'updateProfile'])->name('profile.update');
        Route::post('logout', [App\Http\Controllers\Institute\Auth\LoginController::class, 'logout'])->name('logout');
    });
});