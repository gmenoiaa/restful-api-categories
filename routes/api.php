<?php

use App\Category;
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


//Route::get('categories/{id}', 'CategoryController@show');
//Route::post('categories', 'CategoryController@create');
//Route::patch('categories/{id}', 'CategoryController@update');

Route::resource('categories', 'CategoryController', ['only' => [
    'store', 'show', 'update'
]]);

Route::get('categories/find/{slug}', 'CategoryController@find');
Route::get('categories/tree/{id}', 'CategoryController@tree');