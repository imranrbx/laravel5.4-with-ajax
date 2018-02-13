<?php

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

Route::middleware('ajax.check')->group(function(){
	Route::get('tasks', 'TodoController@index');
	Route::get('todo/create', 'TodoController@create');
	Route::get('todo/edit/{id}', 'TodoController@edit');
	Route::get('todo/destroy/{id}', 'TodoController@destroy');
	Route::get('todo/search/', 'TodoController@search');
	Route::post('todo/update', 'TodoController@update');
	Route::post('todo/save', 'TodoController@save');
});