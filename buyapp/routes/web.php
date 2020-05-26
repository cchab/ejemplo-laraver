<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/users','UserController@index');
Route::get('/products', 'ProductController@index');
Route::get('/products/{id}/edit', 'ProductController@edit');
Route::get('/products/create', 'ProductController@create');
Route::get('/products/list', 'ProductController@list');
Route::get('/products/show_car', 'ProductController@showCar');
Route::post('/products', 'ProductController@store');
Route::put('/products/{id}', 'ProductController@update');
Route::delete('/products/{id}', 'ProductController@destroy');

Route::get('/purchases/create','PurchaseController@create');
