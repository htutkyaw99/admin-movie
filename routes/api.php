<?php

use App\Http\Controllers\Api\Admin\AdminApiController;
use App\Http\Controllers\Api\LoginController;
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
