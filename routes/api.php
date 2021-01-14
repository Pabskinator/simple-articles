<?php

use Illuminate\Support\Facades\Route;

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

Route::get('check_user', function (){
    return Auth::user();
});

Route::get('/articles', 'ArticleController@index')->name('articles.index');
Route::get('/articles/{article}', 'ArticleController@show')->name('articles.show');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/articles', 'ArticleController@store');
    Route::get('/articles/{article}/edit', 'ArticleController@edit');
    Route::put('/articles/{article}', 'ArticleController@update');
    Route::delete('/articles/{article}', 'ArticleController@destroy');
});


