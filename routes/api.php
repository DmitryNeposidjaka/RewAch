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


Route::prefix('v1')->post('login', 'Api\LoginController')->middleware(['throttle:10,1'])->name('login');

Route::prefix('v1')->namespace('Api')->middleware('auth:api')->group(function () {
    Route::post('logout', 'LogoutController')->middleware('auth:api')->name('logout');

    Route::prefix('achievement')->group(function () {
        Route::get('/all', 'AchievementController@getAll')->name('achievement.all')->middleware('permission:get achievements');
        Route::get('/my', 'AchievementController@getMy')->name('achievement.my')->middleware('permission:get achievements');
        Route::get('/waiting', 'AchievementController@getWaiting')->name('achievement.waiting')->middleware('permission:get waiting achievements');
        Route::get('/{achievement}/detail', 'AchievementController@detail')->name('achievement.detail')->middleware('permission:get achievements');
        Route::post('{achievement}/attach/category/{entity}', 'AchievementController@attach')->name('achievement.attach.category')->middleware('permission:achievement attach category');
        Route::delete('{achievement}/detach/category/{entity}', 'AchievementController@detach')->name('achievement.detach.category')->middleware('permission:achievement detach category');
        Route::post('{achievement}/attach/tag/{entity}', 'AchievementController@attach')->name('achievement.attach.tag')->middleware('permission:achievement attach tag');
        Route::delete('{achievement}/detach/tag/{entity}', 'AchievementController@detach')->name('achievement.detach.tag')->middleware('permission:achievement detach tag');
        Route::post('/', 'AchievementController@create')->name('achievement.create')->middleware('permission:create achievement');
        Route::post('/{achievement}', 'AchievementController@update')->name('achievement.update')->middleware('permission:edit achievement');
        Route::delete('/{achievement}', 'AchievementController@delete')->name('achievement.delete')->middleware('permission:delete achievement');
    });

    Route::prefix('approve')->group(function() {
         Route::get('/all', 'ApproveController@getAll')->name('approve.all')->middleware('permission:approve achievement allow');
         Route::post('/achievement/{entity}/allow', 'ApproveController@entityAllow')->name('approve.achievement.allow')->middleware('can:approve achievement allow,entity');
         Route::post('/achievement/{entity}/deny', 'ApproveController@entityDeny')->name('approve.achievement.deny')->middleware('permission:approve achievement deny');
         Route::post('/reward/{entity}/allow', 'ApproveController@entityAllow')->name('approve.reward.allow')->middleware('permission:approve reward allow');
         Route::post('/reward/{entity}/deny', 'ApproveController@entityDeny')->name('approve.reward.deny')->middleware('permission:approve achievement deny');
    });

    Route::prefix('reward')->group(function () {
        Route::get('/all', 'RewardController@getAll')->name('reward.all')->middleware('permission:get rewards');
        Route::get('/waiting', 'RewardController@getWaiting')->name('reward.waiting')->middleware('permission:get waiting rewards');
        Route::post('/{achievement}/to/{user}', 'RewardController@create')->name('reward.create')->middleware('permission:reward achievement');
        Route::post('/{achievement}/to/{user}/deny', 'RewardController@delete')->name('reward.delete')->middleware('permission:remove reward achievement');
    });

    Route::prefix('category')->group(function () {
        Route::get('/all', 'CategoryController@index')->name('category.all')->middleware('permission:get categories');
        Route::get('/{category}/detail', 'CategoryController@show')->name('category.detail')->middleware('permission:get categories');
        Route::post('/create', 'CategoryController@store')->name('category.create')->middleware('permission:create category');
        Route::post('/{category}/update', 'CategoryController@update')->name('category.update')->middleware('permission:update category');
        Route::delete('/{category}/delete', 'CategoryController@destroy')->name('category.delete')->middleware('permission:delete category');
    });

    Route::prefix('tag')->group(function () {
        Route::get('/all', 'TagController@index')->name('tag.all')->middleware('permission:get tags');
        Route::get('/{tag}/detail', 'TagController@show')->name('tag.detail')->middleware('permission:get tags');
        Route::post('/create', 'TagController@store')->name('tag.create')->middleware('permission:create tag');
        Route::post('/{tag}/update', 'TagController@update')->name('tag.update')->middleware('permission:update tag');
        Route::delete('/{tag}/delete', 'TagController@destroy')->name('tag.delete')->middleware('permission:delete tag');
    });
});