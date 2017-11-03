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


Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::post('register', 'Auth\RegisterController@register');
    Route::post('logout', 'Auth\LoginController@logout');
    Route::apiResource('vacation', 'VacationRequestsController');
    Route::get('vacation-approve/{id}', 'VacationRequestsController@approveVacation');
});
