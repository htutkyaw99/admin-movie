<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Movie\MovieController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard.panel');
})->name('dashboard');


//users

Route::resource('admins', AdminController::class);

//movies

Route::resource('movies', MovieController::class);
