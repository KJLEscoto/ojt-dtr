<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('show.register');

Route::get('/login', function () {
    return view('auth.login');
})->name('show.login');

Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('show.reset-password');

Route::get('/dashboard', function () {
    return view('users.dashboard');
})->name('show.users-dashboard');

Route::get('/settings', function () {
    return view('users.settings');
})->name('show.users-settings');

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('show.admin-login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('show.admin-dashboard');