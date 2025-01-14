<?php

use App\Http\Controllers\Api\Admin\AdminApiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Movie\MovieApiController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Web\Movie\MovieController;
use Illuminate\Support\Facades\Route;



//users
Route::prefix('users')->group(function () {
    Route::get('', [AdminApiController::class, 'index'])->name('apiUser.list');
    Route::post('', [AdminApiController::class, 'store'])->name('apiUser.store');
    Route::get('/{id}', [AdminApiController::class, 'show'])->name('apiUser.details');
    Route::put('/{id}', [AdminApiController::class, 'update'])->name('apiUser.update');
    Route::delete('/{id}', [AdminApiController::class, 'destroy'])->name('apiUser.delete');
});

//users

Route::prefix('users')->group(function () {
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
});

//movies
Route::prefix('movies')->group(function () {
    Route::get('', [MovieApiController::class, 'index'])->name('apiMovie.list');
    Route::post('', [MovieApiController::class, 'store'])->name('apiMovie.store');
    Route::get('/favourites', [MovieApiController::class, 'favourite_list'])->name('apiMovie.favlist')->middleware('auth:sanctum');
    Route::post('/favourites/{id}', [MovieApiController::class, 'favourite'])->name('apiMovie.fav')->middleware('auth:sanctum');
    Route::get('/trash', [MovieApiController::class, 'trash'])->name('apiMovie.trash');
    Route::delete('/trash/{id}', [MovieApiController::class, 'delete'])->name('apiMovie.forcedelete');
    Route::post('/trash/{id}', [MovieApiController::class, 'restore'])->name('apiMovie.restore');
    Route::get('/{id}', [MovieApiController::class, 'show'])->name('apiMovie.details');
    Route::patch('/{id}', [MovieApiController::class, 'update'])->name('apiMovie.update');
    Route::delete('/{id}', [MovieApiController::class, 'destroy'])->name('apiMovie.delete');
});
