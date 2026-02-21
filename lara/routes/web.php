<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;

// Публичные маршруты
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::post('/booking/{booking}/payment', [BookingController::class, 'payment'])->name('booking.payment');

// Админ-панель (в реальном проекте добавьте middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/skates', [AdminController::class, 'storeSkate'])->name('skates.store');
    Route::put('/skates/{skate}', [AdminController::class, 'updateSkate'])->name('skates.update');
    Route::delete('/skates/{skate}', [AdminController::class, 'deleteSkate'])->name('skates.delete');
});