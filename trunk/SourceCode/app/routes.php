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
Route::any('userinfo/popup', 'UserInfoController@popup');
Route::any('userinfo/create', 'UserInfoController@create');
Route::any('userinfo/edit/{id}', 'UserInfoController@edit');
Route::any('userinfo/delete/{id}', 'UserInfoController@delete');
Route::any('userinfo/detail/{id}', 'UserInfoController@detail');

Route::any('usergroup', 'UserGroupController@index');
Route::any('usergroup/popup', 'UserGroupController@popup');
Route::any('usergroup/create', 'UserGroupController@create');
Route::any('usergroup/edit/{id}', 'UserGroupController@edit');
Route::any('usergroup/delete/{id}', 'UserGroupController@delete');
Route::any('usergroup/detail/{id}', 'UserGroupController@detail');

Route::any('privilegeinfo', 'PrivilegeInfoController@index');
Route::any('privilegeinfo/popup', 'PrivilegeInfoController@popup');
Route::any('privilegeinfo/create', 'PrivilegeInfoController@create');
Route::any('privilegeinfo/edit/{id}', 'PrivilegeInfoController@edit');
Route::any('privilegeinfo/delete/{id}', 'PrivilegeInfoController@delete');
Route::any('privilegeinfo/detail/{id}', 'PrivilegeInfoController@detail');

Route::any('functioninfo', 'FunctionInfoController@index');
Route::any('functioninfo/popup', 'FunctionInfoController@popup');
Route::any('functioninfo/create', 'FunctionInfoController@create');
Route::any('functioninfo/edit/{id}', 'FunctionInfoController@edit');
Route::any('functioninfo/delete/{id}', 'FunctionInfoController@delete');
Route::any('functioninfo/detail/{id}', 'FunctionInfoController@detail');

Route::any('course', 'CourseController@index');
Route::any('course/popup', 'CourseController@popup');
Route::any('course/create', 'CourseController@create');
Route::any('course/edit/{id}', 'CourseController@edit');
Route::any('course/delete/{id}', 'CourseController@delete');
Route::any('course/detail/{id}', 'CourseController@detail');


