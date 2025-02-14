<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DtrSummaryController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\SearchController;

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('show.register');

Route::get('/test', function () {
    return view('test');
})->name('test');

// Route::get('/dashboard', function () {
//     return view('users.dashboard');
// })->name('show.users-dashboard');

// Route::get('/settings', function () {
//     return view('users.settings');
// })->name('show.users-settings');



// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('show.admin-dashboard');


Route::middleware('guest')->group(function () {

    //users page transition
    Route::get('/users', [UserController::class, 'showUsers'])->name('show.users');
    //login page transition
    //Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');
    //login admin login page transition
    //Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('show.admin.login');
    //register page transition
    Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');

    //login post method
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login');
});

//register post method

Route::middleware('auth')->group(function () {

    Route::post('/download-pdf', [PDFController::class, 'download'])->name('download.pdf');

    //user dashboard
    Route::get('/dashboard', [UserController::class, 'showUserDashboard'])->name('users.dashboard');

    //user settings
    Route::get('/settings', [UserController::class, 'showSettings'])->name('users.settings');

    Route::get('/admin/dashboard', [UserController::class, 'showAdminDashboard'])->name('admin.dashboard');

    //user index page
    Route::get('/users', [UserController::class, 'index'])->name('users.profile.index');


    //scanner user validation data
    Route::get('scanner/{qr_code}', [UserController::class, 'AdminScannerValidation'])->name('admin.scanner.validation');


    //admin scanner
    //Route::get('/admin/scanner', [UserController::class, 'showAdminScanner'])->name('admin.scanner');
    //admin user index page
    Route::get('/admin/users', [UserController::class, 'showAdminUsers'])->name('admin.users');

    //users specific profile
    Route::get('/admin/users/{id}', [UserController::class, 'showUserDetails'])->name('admin.users.details');
    
    //admin user dtr page
    Route::get('/admin/users/{id}/dtr', [DtrSummaryController::class, 'showAdminUserDtr'])->name('admin.users.dtr');

    Route::post('/admin/users/{id}/dtr/post', [DtrSummaryController::class, 'ShowAdminUserDtrPagination'])->name('admin.users.dtr.post');


    //admin history
    Route::get('/admin/history', [UserController::class, 'showAdminHistory'])->name('admin.histories');

    //admin profile
    Route::get('/admin/profile', [UserController::class, 'showAdminProfile'])->name('admin.profile');


    //admin profile
    //Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('user.profile');

    //admin dtr page
    //Route::get('/admin/dtr', [DtrSummaryController::class, 'showAdminSingleUserDtr'])->name('admin.users.dtr');

    //dtr page
    Route::get('/dtr', [DtrSummaryController::class, 'showUserDtr'])->name('users.dtr');

    //dtr summary page
    Route::get('/dtr/summary', [DtrSummaryController::class, 'showUserDtrSummary'])->name('users.dtr.summary');

    Route::post('/dtr/post', [DtrSummaryController::class, 'ShowUserDtrPagination'])->name('users.dtr.post');

    //admin history post method
    Route::post('/history', [UserController::class, 'AdminScannerTimeCheck'])->name('admin.history.time.check');

    //logout post method
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //update user post method
    Route::put('/update', [UserController::class, 'update'])->name('users.settings.update');

    //gdrive test api page
    Route::get('/apiTest', function () {
        return view('gdrive.files');
    });
});


//forgot-password page transition
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('show.reset-password');
//reset-password post method
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
//reset-password-validation post method
Route::post('/reset-password-validation', [EmailController::class, 'EmailResetPasswordValidation'])->name('reset-password-validation');

Route::get('/login', function () {
    return view('auth.login');
})->name('show.login');

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('show.admin.login');

//search controller
// Route::get('/search', function () {

// })->name('search');

Route::post('admin/history/search', [SearchController::class, 'searchHistory'])->name('admin.history.search');