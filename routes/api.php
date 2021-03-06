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



Route::prefix('v1')->group(function(){
    Route::post('register', 'API\AuthController@register');
    Route::post('login', 'API\AuthController@login');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('getUser', 'API\AuthController@getUser');
    });
});
