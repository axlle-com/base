<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login', [UserController::class, 'auth']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
});
