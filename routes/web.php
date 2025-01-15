<?php

use App\Http\Controllers\Web\Admin\AdminController;
use App\Http\Controllers\Web\Dashboard\DashboardController;
use App\Http\Controllers\Web\Movie\MovieController;
use App\Models\Movie;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('dashboard.test');
    return redirect('dashboard');
});

//dashboard

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

//Trash route

Route::get('/admins/trash', [AdminController::class, 'trash'])->name('admins.trash');

Route::delete('/admins/trash/{admin}', [AdminController::class, 'delete'])->name('admins.force');

Route::post('/admins/restore/{admin}', [AdminController::class, 'restore'])->name('admins.restore');

Route::get('/movies/trash', [MovieController::class, 'trash'])->name('movies.trash');

Route::delete('/movies/trash/{id}', [MovieController::class, 'delete'])->name('movies.force');

Route::post('/movies/restore/{id}', [MovieController::class, 'restore'])->name('movies.restore');

//users

Route::resource('admins', AdminController::class);

//movies

Route::resource('movies', MovieController::class);
