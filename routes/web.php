<?php

use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

//users
Route::get('/user-management', function () {
    return view('admin.user.user-management');
})->name('user-management');

Route::get('/user-edit', function () {
    return view('admin.user.user-edit');
})->name('user-edit');

Route::get('/user-profile', function () {
    return view('admin.user.user-profile');
})->name('user-profile');

//movies
Route::get('/movie-management', function () {
    return view('admin.movie.movie-management');
})->name('movie-management');

Route::get('/movie-edit', function () {
    return view('admin.movie.movie-edit');
})->name('movie-edit');
