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
        Route::get('/my', 'AchievementController@getMy')->name('achievement.my');
        Route::get('/waiting', 'AchievementController@getWaiting')->name('achievement.waiting');
        Route::get('/{achievement}/detail', 'AchievementController@detail')->name('achievement.detail');
        Route::post('/', 'AchievementController@create')->name('achievement.create');
        Route::post('/{achievement}', 'AchievementController@update')->name('achievement.update');
        Route::delete('/{achievement}', 'AchievementController@delete')->name('achievement.delete');
    });

    Route::prefix('approve')->middleware('auth:api')->group(function() {
         Route::get('/all', 'ApproveController@getAll')->name('approve.all');
         Route::post('/achievement/{entity}/allow', 'ApproveController@entityAllow')->name('approve.achievement.allow');
         Route::post('/achievement/{entity}/deny', 'ApproveController@entityDeny')->name('approve.achievement.deny');
         Route::post('/reward/{entity}/allow', 'ApproveController@entityAllow')->name('approve.reward.allow');
         Route::post('/reward/{entity}/deny', 'ApproveController@entityDeny')->name('approve.reward.deny');
    });

    Route::prefix('reward')->middleware('auth:api')->group(function () {
        Route::get('/all', 'RewardController@getAll')->name('reward.all');
        Route::get('/waiting', 'RewardController@getWaiting')->name('reward.waiting');
        Route::post('/{achievement}/to/{user}', 'RewardController@create')->name('reward.create');
        Route::post('/{achievement}/to/{user}/deny', 'RewardController@delete')->name('reward.delete');
    });

    Route::prefix('category')->middleware('auth:api')->group(function () {
        Route::get('/all', 'CategoryController@index')->name('category.all');
        Route::get('/{category}/detail', 'CategoryController@show')->name('category.detail');
        Route::post('/create', 'CategoryController@store')->name('category.create');
        Route::post('/{category}/update', 'CategoryController@update')->name('category.update');
        Route::delete('/{category}/delete', 'CategoryController@destroy')->name('category.delete');
    });
});