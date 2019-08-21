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

Route::prefix('v1')->namespace('Api')->group(function () {
    Route::post('login', 'LoginController')->middleware('throttle:10,1')->name('login');
    Route::post('logout', 'LogoutController')->middleware('auth:api')->name('logout');

    Route::prefix('achievement')->middleware('auth:api')->group(function () {
        Route::get('/all', 'AchievementController@getAll');
        Route::get('/{achievement}', 'AchievementController@detail');
        Route::post('/', 'AchievementController@create');
        Route::post('/{achievement}', 'AchievementController@update');
        Route::delete('/{achievement}', 'AchievementController@delete');
    });
});