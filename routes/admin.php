<?php

use App\Http\Controllers\Admin\Ajax\AuthAjaxController;
use App\Http\Controllers\Admin\Ajax\GalleryImageAjaxController;
use App\Http\Controllers\Admin\Ajax\ImageAjaxController;
use App\Http\Controllers\Admin\Ajax\InfoBlockAjaxController;
use App\Http\Controllers\Admin\Ajax\InfoBlockHasResourceAjaxController;
use App\Http\Controllers\Admin\Ajax\PageAjaxController;
use App\Http\Controllers\Admin\Ajax\PostAjaxController;
use App\Http\Controllers\Admin\Ajax\PostCategoryAjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InfoBlockController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('login', [AuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('ajax/login', [AuthAjaxController::class, 'login'])->name('admin.ajax.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'employee'], static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::delete('/image/ajax/delete/{id}', [ImageAjaxController::class, 'delete'])->name('admin.image.ajax.delete');

    Route::apiResource('ajax/gallery-image', GalleryImageAjaxController::class, ['as' => 'admin.ajax']);

    Route::group(['prefix' => 'blog'], static function () {
        Route::resource('post', PostController::class, ['as' => 'admin']);
        Route::apiResource('ajax/post', PostAjaxController::class, ['as' => 'admin.ajax']);

        Route::resource('post-category', PostCategoryController::class, ['as' => 'admin']);
        Route::apiResource('ajax/post-category', PostCategoryAjaxController::class, ['as' => 'admin.ajax']);
    });
    Route::resource('page', PageController::class, ['as' => 'admin']);
    Route::apiResource('ajax/page', PageAjaxController::class, ['as' => 'admin.ajax']);

    Route::resource('info-block', InfoBlockController::class, ['as' => 'admin']);
    Route::apiResource('ajax/info-block', InfoBlockAjaxController::class, ['as' => 'admin.ajax']);
    Route::get('ajax/info-block/get-for-resource/{id}', [InfoBlockAjaxController::class, 'getForResource'])
        ->name('admin.ajax.info-block.get-for-resource');

    Route::apiResource('ajax/info-block-has-resource', InfoBlockHasResourceAjaxController::class, ['as' => 'admin.ajax']);
});
