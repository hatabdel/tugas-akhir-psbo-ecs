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


Route::any('forum', 'ForumController@index');
Route::any('forum/popup', 'ForumController@popup');
Route::any('forum/create', 'ForumController@create');
Route::any('forum/edit/{id}', 'ForumController@edit');
Route::any('forum/delete/{id}', 'ForumController@delete');
Route::any('forum/detail/{id}', 'ForumController@detail');


Route::any('comment', 'CommentController@index');
Route::any('comment/popup', 'CommentController@popup');
Route::any('comment/create', 'CommentController@create');
Route::any('comment/edit/{id}', 'CommentController@edit');
Route::any('comment/delete/{id}', 'CommentController@delete');
Route::any('comment/detail/{id}', 'CommentController@detail');


Route::any('quiz', 'QuizController@index');
Route::any('quiz/popup', 'QuizController@popup');
Route::any('quiz/create', 'QuizController@create');
Route::any('quiz/edit/{id}', 'QuizController@edit');
Route::any('quiz/delete/{id}', 'QuizController@delete');
Route::any('quiz/detail/{id}', 'QuizController@detail');

Route::any('quiztype', 'QuizTypeController@index');
Route::any('quiztype/popup', 'QuizTypeController@popup');
Route::any('quiztype/create', 'QuizTypeController@create');
Route::any('quiztype/edit/{id}', 'QuizTypeController@edit');
Route::any('quiztype/delete/{id}', 'QuizTypeController@delete');
Route::any('quiztype/detail/{id}', 'QuizTypeController@detail');

Route::any('studentquiz', 'StudentQuizController@index');
Route::any('studentquiz/popup', 'StudentQuizController@popup');
Route::any('studentquiz/create', 'StudentQuizController@create');
Route::any('studentquiz/edit/{id}', 'StudentQuizController@edit');
Route::any('studentquiz/delete/{id}', 'StudentQuizController@delete');
Route::any('studentquiz/detail/{id}', 'StudentQuizController@detail');

Route::any('studentanswer', 'StudentAnswerController@index');
Route::any('studentanswer/popup', 'StudentAnswerController@popup');
Route::any('studentanswer/create', 'StudentAnswerController@create');
Route::any('studentanswer/edit/{id}', 'StudentAnswerController@edit');
Route::any('studentanswer/delete/{id}', 'StudentAnswerController@delete');
Route::any('studentanswer/detail/{id}', 'StudentAnswerController@detail');

Route::any('quizquestion', 'QuizQuestionController@index');
Route::any('quizquestion/popup', 'QuizQuestionController@popup');
Route::any('quizquestion/create', 'QuizQuestionController@create');
Route::any('quizquestion/edit/{id}', 'QuizQuestionController@edit');
Route::any('quizquestion/delete/{id}', 'QuizQuestionController@delete');
Route::any('quizquestion/detail/{id}', 'QuizQuestionController@detail');

Route::any('answer', 'AnswerController@index');
Route::any('answer/popup', 'AnswerController@popup');
Route::any('answer/create', 'AnswerController@create');
Route::any('answer/edit/{id}', 'AnswerController@edit');
Route::any('answer/delete/{id}', 'AnswerController@delete');
Route::any('answer/detail/{id}', 'AnswerController@detail');

