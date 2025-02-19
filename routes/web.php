<?php

use App\Http\Controllers\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\PaymentManagement\PaymentController;
use App\Http\Controllers\Admin\SubscriptionManagement\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionManagement\InstituteSubscriptionController;
use App\Http\Controllers\Admin\EmployeeManagement\EmployeeController;
use App\Http\Controllers\Admin\InstituteManagement\InstituteController;
use App\Http\Controllers\Institute\Auth\InstituteForgotPasswordController;
use App\Http\Controllers\Institute\Auth\InstituteResetPasswordController;
use App\Http\Controllers\Institute\Auth\LoginController as InstituteLoginController;
use App\Http\Controllers\Institute\Auth\RegisterController as InstituteRegisterController;
use App\Http\Controllers\Institute\InstituteController as InstituteInstituteController;
use App\Http\Controllers\Institute\ThemeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Admin Login Routes
Route::controller(AdminLoginController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/login', 'loginCheck')->name('login');
    Route::post('/logout', 'logout')->name('logout');
});
Route::controller(AdminForgotPasswordController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/password/forgot', 'showLinkRequestForm')->name('forgot');
    Route::post('/password/forgot/request', 'sendResetLinkEmail')->name('forgot.request');
});
Route::controller(AdminResetPasswordController::class)->prefix('admin')->name('admin.')->group(function () {
    Route::get('/password/reset/{token}', 'showResetForm')->name('reset');
    Route::post('/password/reset', 'reset')->name('reset.request');
});

// Admin Dashboard Routes
Route::group(['middleware' => 'auth:admin'], function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::group(['as' => 'am.', 'prefix' => 'admin-management'], function () {
        Route::resource('admin', AdminController::class);
        Route::get('admin/status/{admin}', [AdminController::class, 'status'])->name('admin.status');
        Route::get('admin/profile/details', [AdminController::class, 'profile'])->name('admin.profile');
        Route::put('admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    });

    Route::group(['as' => 'em.', 'prefix' => 'employee-management'], function () {
        Route::resource('employee', EmployeeController::class);
        Route::get('employee/status/{employee}/{status}', [EmployeeController::class, 'status'])->name('employee.status');
        Route::get('employee/profile/{employee}', [EmployeeController::class, 'profile'])->name('employee.profile');
        Route::put('employee/profile/update/{employee}', [EmployeeController::class, 'updateProfile'])->name('employee.profile.update');
    });

    Route::group(['as' => 'im.', 'prefix' => 'institute-management'], function () {
        Route::resource('institute', InstituteController::class);
        Route::get('institute/status/{institute}', [InstituteController::class, 'status'])->name('institute.status');
        Route::get('institute/profile/{institute}', [InstituteController::class, 'profile'])->name('institute.profile');
        Route::put('institute/profile/update/{institute}', [InstituteController::class, 'updateProfile'])->name('institute.profile.update');
    });

    Route::group(['as' => 'sm.', 'prefix' => 'subscription-management'], function () {
        Route::resource('subscription', SubscriptionController::class);
        Route::get('subscription/status/{subscription}', [SubscriptionController::class, 'status'])->name('subscription.status');
        Route::resource('institute-subscription', InstituteSubscriptionController::class);
    });

    Route::group(['as' => 'pm.', 'prefix' => 'payment-management'], function () {
        Route::resource('payment', PaymentController::class)->only(['index']);
    });

    Route::group(['as' => 'jc.', 'prefix' => 'job-category'], function () {
        Route::resource('job-category', JobCategoryController::class);
        Route::get('job-category/status/{jobCategory}', [JobCategoryController::class, 'status'])->name('job-category.status');
    });
});

// Institute Auth Routes
Route::prefix('institute')->name('institute.')->group(function () {
    Route::middleware('guest:institute')->group(function () {
        Route::get('login', [InstituteLoginController::class, 'showLoginForm'])->name('login');
        Route::post('login', [InstituteLoginController::class, 'login'])->name('login.submit');
        Route::get('register', [InstituteRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [InstituteRegisterController::class, 'register'])->name('register.submit');

        // Password Reset Routes
        Route::get('password/reset', [InstituteForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [InstituteForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [InstituteResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [InstituteResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::middleware('auth:institute')->group(function () {
        Route::get('dashboard', [InstituteInstituteController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [InstituteInstituteController::class, 'profile'])->name('profile');
        Route::put('profile', [InstituteInstituteController::class, 'updateProfile'])->name('profile.update');
        Route::post('logout', [InstituteLoginController::class, 'logout'])->name('logout');
    });

    Route::group(['prefix' => 'employee-management'], function () {
        Route::resource('employee', EmployeeController::class);
        Route::get('employee/status/{employee}/{status}', [EmployeeController::class, 'status'])->name('employee.status');
        Route::get('employee/profile/{employee}', [EmployeeController::class, 'profile'])->name('employee.profile');
    });

    // Theme routes
    Route::post('/theme/update', [ThemeController::class, 'update'])->name('theme.update');
});
