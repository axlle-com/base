<?php

use App\Http\Controllers\Api\V1\CurrencyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], static function () {
    Route::get('/currency', [CurrencyController::class, 'index']);
    Route::get('/currency-rate', [CurrencyController::class, 'currencyExchangeRate']);
});
