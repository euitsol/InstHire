<?php

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
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
});
