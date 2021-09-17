<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('dailymotion')->group(function () {
    Route::get('/token', 'App\Http\Controllers\dailymotionController@getApiToken');
    Route::post('/videos', 'App\Http\Controllers\dailymotionController@fetchVideos');
    Route::post('/video/{id}', 'App\Http\Controllers\dailymotionController@fetchVideo');
    Route::post('/channel/{id}', 'App\Http\Controllers\dailymotionController@fetchChannel');
});