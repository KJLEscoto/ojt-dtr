<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// Route::get('/register', function () {
//     return view('auth.register');
// })->name('show.register');

Route::get('/login', function () {
    return view('auth.login');
})->name('show.login');

// Route::get('/reset-password', function () {
//     return view('auth.reset-password');
// })->name('show.reset-password');

// Route::get('/dashboard', function () {
//     return view('users.dashboard');
// })->name('show.users-dashboard');

// Route::get('/settings', function () {
//     return view('users.settings');
// })->name('show.users-settings');

// Route::get('/admin/login', function () {
//     return view('auth.login');
// })->name('show.admin-login');

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
});

//register post method

Route::middleware('auth')->group(function () {

    //user dashboard
    Route::get('/dashboard', [UserController::class, 'showDashboard'])->name('users.dashboard');
    
    //user settings
    Route::get('/settings', [UserController::class, 'showSettings'])->name('users.settings');
    
    Route::get('/admin/dashboard', [UserController::class, 'showDashboard'])->name('admin.dashboard');

    //user index page
    Route::get('/users', [UserController::class, 'index'])->name('users.profile.index');


    //scanner user validation data
    Route::get('scanner/{qr_code}', [UserController::class, 'AdminScannerValidation'])->name('admin.scanner.validation');

    //admin user index page
    Route::get('/admin/users', [UserController::class, 'showAdminUsers'])->name('admin.users');

    //admin scanner
    Route::get('/admin/scanner', [UserController::class, 'showAdminScanner'])->name('admin.scanner');

    //admin history
    Route::get('/admin/history', [UserController::class, 'showAdminHistory'])->name('admin.histories');
    
    //admin profile
    Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('user.profile');
    
    //admin profile
    Route::get('/admin/profile/{id}', [UserController::class, 'showProfile'])->name('admin.user.profile');
    
    //admin dtr page
    Route::get('/admin/dtr', [UserController::class, 'showAdminDTR'])->name('admin.user.dtr');
    
    //dtr page
    Route::get('/dtr', [UserController::class, 'showDTR'])->name('user.dtr');
    
    //admin history post method
    Route::post('/history', [UserController::class, 'AdminScannerTimeCheck'])->name('admin.history.time.check');
    
    //logout post method
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //update user post method
    Route::put('/update/{id}', [UserController::class, 'update'])->name('users.profile.update');
    
    //gdrive test api page
    Route::get('/apiTest', function(){
        return view('gdrive.files');
    });
});


//forgot-password page transition
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('show.reset-password');
//reset-password post method
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');
//reset-password-validation post method
Route::post('/reset-password-validation', [EmailController::class, 'EmailResetPasswordValidation'])->name('reset-password-validation');