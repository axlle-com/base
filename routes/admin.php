<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], static function () {});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], static function () {});
