<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::any('/', 'HomeController@Index');
Route::any('userinfo', 'UserInfoController@index');
Route::any('userinfo/create', 'UserInfoController@create');

Route::any('functioninfo', 'FunctionInfoController@index');
Route::any('functioninfo/popup', 'FunctionInfoController@popup');
Route::any('functioninfo/create', 'FunctionInfoController@create');
Route::any('functioninfo/edit/{id}', 'FunctionInfoController@edit');
Route::any('functioninfo/delete/{id}', 'FunctionInfoController@delete');
Route::any('functioninfo/detail/{id}', 'FunctionInfoController@detail');


