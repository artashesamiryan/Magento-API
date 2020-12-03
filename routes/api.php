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

Route::post('/auth/getToken', 'AuthController@getToken');

Route::post('/fitments/push', 'FitmentController@push');

Route::get('/products/fetch', 'ProductController@fetch');
Route::get('/products/get', 'ProductController@get');

Route::get('/categories/fetch', 'CategoryController@fetch');
Route::get('/categories/get', 'CategoryController@get');

Route::get('/orders/fetch', 'OrderController@fetch');
Route::get('/orders/get', 'OrderController@get');