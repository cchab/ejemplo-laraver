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
Route::post('/users/login','UserAppController@login');
Route::post('/users','UserAppController@store');
Route::post('/events','EventController@store');
Route::get('/events/{uid}/show','EventController@show');
Route::put('/events/{uid}','EventController@update');
Route::delete('/events/{uid}','EventController@delete');
