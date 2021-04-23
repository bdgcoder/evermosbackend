<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('cart','App\Http\Controllers\CartsController@store');
Route::post('cancel','App\Http\Controllers\CartsController@cancel');
Route::post('pay','App\Http\Controllers\CartsController@pay');
Route::post('delivery','App\Http\Controllers\CartsController@delivery');