<?php

use App\Http\Controllers\Admin\Ajax\AuthAjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AuthAjaxController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});
