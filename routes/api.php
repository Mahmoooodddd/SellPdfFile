<?php

use Illuminate\Http\Request;

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


Route::get('/book','BookController@index');
Route::get('/book/detail/{id}','BookController@detail');

Route::get('/author','AuthorController@index');
Route::get('/author/detail/{id}','AuthorController@detail');


Route::get('/basket','BasketController@index');
Route::post('/basket/{id}','BasketController@add');
Route::delete('/basket/delete/{id}','BasketController@delete');

Route::post('/order/create','OrderController@create')->middleware('auth');
Route::get('/user/orders','OrderController@index')->middleware('auth');


Route::get('/payment/{id}','PaymentController@show');
Route::post('/callback/{id}/{status}','PaymentController@callback');


Route::get('admin/users','Admin\UserController@index');
Route::get('admin/orders','Admin\OrderController@index');



