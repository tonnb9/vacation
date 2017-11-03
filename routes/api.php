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

Route::resource('vacation', 'VacationRequestsController');
Route::post('login', 'Auth\LoginController@login');
Route::post('register', 'Auth\RegisterController@register');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('logout', 'Auth\LoginController@logout');

});
