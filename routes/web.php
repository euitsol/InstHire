<?php

use App\Http\Controllers\Admin\AdminManagement\AdminController;
use App\Http\Controllers\Admin\Auth\AdminForgotPasswordController;
use App\Http\Controllers\Admin\Auth\AdminResetPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\JobManagement\JobCategoryController;
use App\Http\Controllers\Admin\JobManagement\JobPostController as AdminJobPostController;
use App\Http\Controllers\Admin\PaymentManagement\PaymentController;
use App\Http\Controllers\Admin\SubscriptionManagement\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionManagement\InstituteSubscriptionController;
use App\Http\Controllers\Admin\EmployeeManagement\EmployeeController;
use App\Http\Controllers\Admin\InstituteManagement\InstituteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Institute\Auth\InstituteForgotPasswordController;
use App\Http\Controllers\Institute\Auth\InstituteResetPasswordController;
use App\Http\Controllers\Institute\Auth\LoginController as InstituteLoginController;
use App\Http\Controllers\Institute\Auth\RegisterController as InstituteRegisterController;
use App\Http\Controllers\Institute\EmployeeManagement\EmployeeController as InstituteEmployeeController;
use App\Http\Controllers\Institute\InstituteController as InstituteInstituteController;
use App\Http\Controllers\Institute\JobPostManagement\JobPostController;
use App\Http\Controllers\Institute\Setup\DepartmentController;
use App\Http\Controllers\Institute\Setup\SessionController;
use App\Http\Controllers\Institute\StudentManagement\StudentController as InstituteStudentController;
use App\Http\Controllers\Institute\ThemeController;
use App\Http\Controllers\Institute\Setup\JobFairStallOptionController as InstituteJobFairStallOptionController;
use App\Http\Controllers\Institute\JobFair\JobFairController as InstituteJobFairController;
use App\Http\Controllers\Student\Auth\LoginController as StudentLoginController;
use App\Http\Controllers\Student\Auth\RegisterController as StudentRegisterController;
use App\Http\Controllers\Student\Auth\ForgotPasswordController as StudentForgotPasswordController;
use App\Http\Controllers\Student\Auth\ResetPasswordController as StudentResetPasswordController;
use App\Http\Controllers\Student\ProfileController as StudentProfileController;
use App\Http\Controllers\Student\CVController as StudentCVController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\JobController as FrontendJobController;
use App\Http\Controllers\Student\StudentController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return redirect()->route('login');
// })->name('login_stater');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(FrontendHomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

Route::controller(FrontendJobController::class)->group(function () {
    Route::get('/jobs', 'index')->name('frontend.jobs');
    Route::get('/jobs/{id}', 'show')->name('frontend.jobs.show');
});

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

    Route::group(['as' => 'jm.', 'prefix' => 'job-management'], function () {
        Route::resource('job-category', JobCategoryController::class);
        Route::get('job-category/status/{jobCategory}', [JobCategoryController::class, 'status'])->name('job-category.status');
        Route::resource('job-post', AdminJobPostController::class);
    });
});

// Institute Auth Routes
Route::prefix('institute')->name('institute.')->group(function () {

        Route::get('login', [InstituteLoginController::class, 'login'])->name('login');
        Route::post('login', [InstituteLoginController::class, 'loginCheck'])->name('login.submit');
        Route::get('register', [InstituteRegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('register', [InstituteRegisterController::class, 'register'])->name('register.submit');

        // Password Reset Routes
        Route::get('password/reset', [InstituteForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('password/email', [InstituteForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('password/reset/{token}', [InstituteResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('password/reset', [InstituteResetPasswordController::class, 'reset'])->name('password.update');


    Route::middleware('auth:institute')->group(function () {
        Route::get('dashboard', [InstituteInstituteController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [InstituteInstituteController::class, 'profile'])->name('profile');
        Route::put('profile', [InstituteInstituteController::class, 'updateProfile'])->name('profile.update');
        Route::post('logout', [InstituteLoginController::class, 'logout'])->name('logout');

        // Employee Management Routes
        Route::group(['prefix' => 'employee-management'], function () {
            Route::resource('employee', InstituteEmployeeController::class);
            Route::get('employee/status/{employee}/{status}', [InstituteEmployeeController::class, 'status'])->name('employee.status');
            Route::get('employee/profile/{employee}', [InstituteEmployeeController::class, 'profile'])->name('employee.profile');
        });

        // Student Management Routes
        Route::group(['prefix' => 'student-management'], function () {
            Route::resource('student', InstituteStudentController::class);
            Route::get('student/status/{student}/{status}', [InstituteStudentController::class, 'status'])->name('student.status');
            Route::get('student/profile/{student}', [InstituteStudentController::class, 'profile'])->name('student.profile');
        });

        // Job Post Management Routes
        Route::group(['prefix' => 'job-post-management'], function () {
            Route::resource('job-post', JobPostController::class);
            Route::get('job-post/status/{jobPost}/{status}', [JobPostController::class, 'status'])->name('job-post.status');
            Route::get('job-post/profile/{jobPost}', [JobPostController::class, 'profile'])->name('job-post.profile');
        });

        // Setup Routes
        Route::prefix('setup')->name('setup.')->group(function () {
            // Department Routes
            Route::get('departments', [DepartmentController::class, 'index'])->name('department.index');
            Route::post('departments', [DepartmentController::class, 'store'])->name('department.store');
            Route::get('departments/{department}', [DepartmentController::class, 'show'])->name('department.show');
            Route::put('departments/{department}', [DepartmentController::class, 'update'])->name('department.update');
            Route::get('departments/toggle-status/{department}', [DepartmentController::class, 'toggleStatus'])->name('department.toggle-status');
            Route::delete('departments/delete/{department}', [DepartmentController::class, 'delete'])->name('department.delete');

            // Session Routes
            Route::get('sessions', [SessionController::class, 'index'])->name('session.index');
            Route::post('sessions', [SessionController::class, 'store'])->name('session.store');
            Route::get('sessions/{session}', [SessionController::class, 'show'])->name('session.show');
            Route::put('sessions/{session}', [SessionController::class, 'update'])->name('session.update');
            Route::get('sessions/toggle-status/{session}', [SessionController::class, 'toggleStatus'])->name('session.toggle-status');
            Route::delete('sessions/delete/{session}', [SessionController::class, 'delete'])->name('session.delete');

            Route::controller(InstituteJobFairStallOptionController::class)->prefix('job-fair-stall')->name('jfs.')->group(function () {
                Route::get('list', 'list')->name('list');
                Route::get('create', 'create')->name('create');
                Route::post('store', 'store')->name('store');

                Route::get('edit/{stallOption}', 'edit')->name('edit');
                Route::put('update/{stallOption}', 'update')->name('update');

                Route::get('show/{stallOption}', 'show')->name('show');;
                Route::get('toggle-status/{stallOption}', 'toggleStatus')->name('toggle-status');
                Route::delete('delete/{stallOption}', 'delete')->name('delete');
            });

        });

        Route::controller(InstituteJobFairController::class)->prefix('job-fair')->name('jf.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('show/{jobFair}', 'show')->name('show');
            Route::get('edit/{jobFair}', 'edit')->name('edit');
            Route::put('update/{jobFair}', 'update')->name('update');
            Route::delete('delete/{jobFair}', 'destroy')->name('destroy');
            Route::get('active-options', 'getActiveOptions')->name('getActiveOptions');
        });

        // Theme routes
        Route::post('/theme/update', [ThemeController::class, 'update'])->name('theme.update');
    });
});

// Student Auth Routes
Route::prefix('student')->name('student.')->group(function () {
    Route::controller(StudentLoginController::class)->group(function() {
        Route::get('/login', 'login')->name('login');
        Route::post('/login', 'loginCheck')->name('login');
        Route::post('/logout', 'logout')->name('logout')->middleware('auth:student');
    });

    Route::controller(StudentRegisterController::class)->group(function() {
        Route::get('/register', 'register')->name('register');
        Route::post('/register', 'store')->name('register');
        Route::get('department/{institute}', 'departments')->name('departments');
        Route::get('session/{institute}', 'sessions')->name('sessions');
    });

    Route::controller(StudentForgotPasswordController::class)->group(function() {
        Route::get('/password/forgot', 'showLinkRequestForm')->name('forgot');
        Route::post('/password/forgot/request', 'sendResetLinkEmail')->name('forgot.request');
    });

    Route::controller(StudentResetPasswordController::class)->group(function() {
        Route::get('/password/reset/{token}', 'showResetForm')->name('reset');
        Route::post('/password/reset', 'reset')->name('password.update');
    });

    Route::controller(StudentController::class)->middleware('auth:student')->group(function() {
        Route::get('/dashboard', 'dashboard')->name('dashboard');
    });

    Route::controller(StudentProfileController::class)->middleware('auth:student')->prefix('profile')->as('profile.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::put('/update', 'update')->name('update');
    });

    Route::controller(StudentCVController::class)->middleware('auth:student')->prefix('cv')->as('cv.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::put('/upload', 'update')->name('upload');
        Route::delete('/delete/{id}', 'delete')->name('delete');
    });
});
