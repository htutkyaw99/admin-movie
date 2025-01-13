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

//users

Route::resource('admins', AdminController::class);

//Trash route

Route::get('/movies/trash', [MovieController::class, 'trash'])->name('movies.trash');

Route::delete('/movies/trash/{movie}', [MovieController::class, 'delete'])->name('movies.force');

Route::post('/movies/restore/{movie}', [MovieController::class, 'restore'])->name('movies.restore');


//movies

Route::resource('movies', MovieController::class);
