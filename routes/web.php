<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

Route::get('/user-management', function () {
    return view('admin.user-management');
})->name('user-management');

Route::get('/movie-management', function () {
    return view('admin.movie-management');
})->name('movie-management');
