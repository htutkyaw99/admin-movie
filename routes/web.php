<?php

use App\Http\Controllers\Web\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.panel');
})->name('dashboard');

Route::resource('admins', AdminController::class);

//movies
Route::get('/movie-management', function () {
    return view('admin.movie.movie-management');
})->name('movie-management');

Route::get('/movie-edit', function () {
    return view('admin.movie.movie-edit');
})->name('movie-edit');

Route::get('/movie-create', function () {
    return view('admin.movie.movie-create');
})->name('movie-create');
