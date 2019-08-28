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
        Route::get('/all', 'AchievementController@getAll')->name('achievement.all');
        Route::get('/waiting', 'AchievementController@getWaiting');
        Route::get('/{achievement}/detail', 'AchievementController@detail')->name('achievement.detail');
        Route::post('/', 'AchievementController@create')->name('achievement.create');
        Route::post('/{achievement}', 'AchievementController@update')->name('achievement.update');
        Route::delete('/{achievement}', 'AchievementController@delete')->name('achievement.delete');
    });

    Route::prefix('approve')->middleware('auth:api')->group(function() {
         Route::get('/all', 'ApproveController@getAll')->name('approve.all');
         Route::post('/{achievement}/allow', 'ApproveController@achievementAllow')->name('approve.allow');
         Route::post('/{achievement}/deny', 'ApproveController@achievementDeny')->name('approve.deny');
    });

    Route::prefix('reward')->middleware('auth:api')->group(function () {
        Route::get('/all', 'rewardController@getAll')->name('reward.all');
        Route::get('/my', 'rewardController@getMy')->name('reward.my');
        Route::post('/{achievement}/to/{user}', 'rewardController@create')->name('reward.create');
        Route::post('/{achievement}/to/{user}/deny', 'rewardController@delete')->name('reward.delete');
    });
});