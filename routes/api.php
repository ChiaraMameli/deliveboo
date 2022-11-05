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

// Route::namespace()->group()

Route::get('/restaurants', 'Api\RestaurantController@index');
Route::get('/restaurants/:slug', 'Api\RestaurantController@show');
Route::get('/orders' , 'Api\OrderController@index');
Route::post('/orders-store' , 'Api\OrderController@store');
//Route::post('/pivot' , 'Api\DishOrderController@store');


//Route::post('/orders/{id}' , 'Api\OrderController@index');
// Route::get('/dishes', 'Api\DishController@index');
// Route::get('/dishes', 'Api\DishController@index');