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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('todos', 'TasksController@index');
Route::get('todos/{id}', 'TasksController@show');
Route::post('todos', 'TasksController@store');
Route::put('todos/{id}', 'TasksController@update');
Route::put('todos/update/completed', 'TasksController@updateTOCompleted');
Route::delete('todos/{id}', 'TasksController@destroy');
Route::delete('todos/destroy/complete', 'TasksController@destroyCompleted');
