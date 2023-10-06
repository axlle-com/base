<?php

use App\Http\Controllers\Admin\Ajax\AuthAjaxController;
use App\Http\Controllers\Admin\Ajax\PageAjaxController;
use App\Http\Controllers\Admin\Ajax\PostAjaxController;
use App\Http\Controllers\Admin\Ajax\PostCategoryAjaxController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PostCategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AuthAjaxController::class, 'login'])->name('admin.login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'employee'], static function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('page', PageController::class);
    Route::apiResource('ajax/page', PageAjaxController::class);

    Route::resource('post', PostController::class);
    Route::apiResource('ajax/post', PostAjaxController::class);

    Route::resource('post-category', PostCategoryController::class);
    Route::apiResource('ajax/post-category', PostCategoryAjaxController::class);


//
//    Route::group(['prefix' => 'user'], static function () {
//        Route::get('/profile', [UserController::class, 'profile']);
//        Route::group(['namespace' => 'Ajax', 'prefix' => 'ajax'], static function () {
//            Route::post('/save', [UserAjaxController::class, 'profile']);
//        });
//    });
//    Route::group(['prefix' => 'blog'], static function () {
//        Route::get('/category', [BlogController::class, 'indexCategory']);
//        Route::post('/category', [BlogController::class, 'indexCategoryPost']);
//        Route::get('/category-update/{id?}', [BlogController::class, 'updateCategory']);
//        Route::get('/category-delete/{id?}', [BlogController::class, 'deleteCategory']);
//
//        Route::get('/post', [BlogController::class, 'indexPost']);
//        Route::post('/post', [BlogController::class, 'indexPostForm']);
//        Route::get('/post-update/{id?}', [BlogController::class, 'updatePost']);
//        Route::get('/post-delete/{id?}', [BlogController::class, 'deletePost'])->name('Delete');
//
//        Route::get('/comment', [BlogCommentController::class, 'index']);
//        Route::post('/comment', [BlogCommentController::class, 'indexPost']);
//        Route::get('/comment-update/{id?}', [BlogCommentController::class, 'update'])->name('Create');
//        Route::get('/comment-delete/{id?}', [BlogCommentController::class, 'deletePost'])->name('Delete');
//
//        Route::group(['prefix' => 'ajax'], static function () {
//            Route::post('/save-category', [BlogAjaxController::class, 'saveCategory']);
//            Route::post('/save-post', [BlogAjaxController::class, 'savePost'])->name('Create');
//            Route::post('/delete-image', [ImageAjaxController::class, 'deleteImage']);
//            Route::post('/delete-widget', [WidgetAjaxController::class, 'deleteWidget']);
//        });
//    });
});
