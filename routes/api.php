<?php

use Illuminate\Http\Request;
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
Route::get('/players', 'QuestionsController@index');
Route::get('/players/{id}', 'QuestionsController@show');
Route::post('/players', 'QuestionsController@store');
Route::post('/players/{id}/answers', 'QuestionsController@answer');
Route::delete('/players/{id}', 'QuestionsController@delete');
Route::delete('/players/{id}/answers', 'QuestionsController@resetAnswers');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
