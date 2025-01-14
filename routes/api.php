<?php

use App\Http\Controllers\Api\Admin\AdminApiController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\Movie\MovieApiController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;



//users
Route::prefix('users')->group(function () {
    Route::get('', [AdminApiController::class, 'index'])->name('apiUser.list');
    Route::post('', [AdminApiController::class, 'store'])->name('apiUser.store');
    Route::get('/{id}', [AdminApiController::class, 'show'])->name('apiUser.details');
    Route::put('/{id}', [AdminApiController::class, 'update'])->name('apiUser.update');
    Route::delete('/{id}', [AdminApiController::class, 'destroy'])->name('apiUser.delete');
});

Route::prefix('movies')->group(function () {
    Route::get('', [MovieApiController::class, 'index'])->name('apiMovie.list');
    Route::post('', [MovieApiController::class, 'store'])->name('apiMovie.store');
    Route::get('/{id}', [MovieApiController::class, 'show'])->name('apiMovie.details');
    Route::put('/{id}', [MovieApiController::class, 'update'])->name('apiMovie.update');
    Route::delete('/{id}', [MovieApiController::class, 'destroy'])->name('apiMovie.delete');
});
