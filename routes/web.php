<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Movie\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('dashboard');
});

//dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//users

Route::resource('admins', AdminController::class);

//movies

Route::resource('movies', MovieController::class);
