<?php

use Illuminate\Http\Request;
use App\Comments;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('comments/{article}', 'ArticleController@show');
Route::post('comments', 'ArticleController@store');
Route::put('comments/{article}', 'ArticleController@update');
Route::delete('comments/{article}', 'ArticleController@delete');

