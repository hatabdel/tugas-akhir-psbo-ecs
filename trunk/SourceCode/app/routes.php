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

$FunctionInfoDao = new FunctionInfoDao();
$FunctionInfoList = $FunctionInfoDao->getList();
if (!is_null($FunctionInfoList) && count($FunctionInfoList) > 0) {
    foreach ($FunctionInfoList as $item) {
        if (is_null($item)) { continue; }
        Route::any($item->getUrl(), $item->getRoute().'Controller@index');
        Route::any($item->getUrl().'/popup', $item->getRoute().'Controller@popup');
        Route::any($item->getUrl().'/create', $item->getRoute().'Controller@create');
        Route::any($item->getUrl().'/edit/{id}', $item->getRoute().'Controller@edit');
        Route::any($item->getUrl().'/delete/{id}', $item->getRoute().'Controller@delete');
        Route::any($item->getUrl().'/detail/{id}', $item->getRoute().'Controller@detail');
    }
} else {
    Route::any('/', 'HomeController@Index');
    Route::any('accessdenied', 'AccessDeniedController@index');
    Route::any('access_denied', 'AccessDeniedController@index');
    Route::any('login', 'LoginController@index');
    Route::any('login/logout', 'LoginController@logout');

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

    Route::any('forum', 'ForumController@index');
    Route::any('forum/popup', 'ForumController@popup');
    Route::any('forum/create', 'ForumController@create');
    Route::any('forum/edit/{id}', 'ForumController@edit');
    Route::any('forum/delete/{id}', 'ForumController@delete');
    Route::any('forum/detail/{id}', 'ForumController@detail');
    Route::any('forum/detilforum/{id}', 'ForumController@detail');

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

    Route::any('answertype', 'AnswerTypeController@index');
    Route::any('answertype/popup', 'AnswerTypeController@popup');
    Route::any('answertype/create/forum_id?', 'AnswerTypeController@create');
    Route::any('answertype/edit/{id}', 'AnswerTypeController@edit');
    Route::any('answertype/delete/{id}', 'AnswerTypeController@delete');
    Route::any('answertype/detail/{id}', 'AnswerTypeController@detail');

    Route::any('attachment', 'AttachmentController@index');
    Route::any('attachment/popup', 'AttachmentController@popup');
    Route::any('attachment/create/forum_id?', 'AttachmentController@create');
    Route::any('attachment/edit/{id}', 'AttachmentController@edit');
    Route::any('attachment/delete/{id}', 'AttachmentController@delete');
    Route::any('attachment/detail/{id}', 'AttachmentController@detail');

    Route::any('coursedetail', 'CourseDetailController@index');
    Route::any('coursedetail/popup', 'CourseDetailController@popup');
    Route::any('coursedetail/create/forum_id?', 'CourseDetailController@create');
    Route::any('coursedetail/edit/{id}', 'CourseDetailController@edit');
    Route::any('coursedetail/delete/{id}', 'CourseDetailController@delete');
    Route::any('coursedetail/detail/{id}', 'CourseDetailController@detail');

    Route::any('quizquestion', 'QuizQuestionController@index');
    Route::any('quizquestion/popup', 'QuizQuestionController@popup');
    Route::any('quizquestion/create/forum_id?', 'QuizQuestionController@create');
    Route::any('quizquestion/edit/{id}', 'QuizQuestionController@edit');
    Route::any('quizquestion/delete/{id}', 'QuizQuestionController@delete');
    Route::any('quizquestion/detail/{id}', 'QuizQuestionController@detail');

    Route::any('webinar', 'WebinarController@index');
    Route::any('webinar/popup', 'WebinarController@popup');
    Route::any('webinar/create', 'WebinarController@create');
    Route::any('webinar/edit/{id}', 'WebinarController@edit');
    Route::any('webinar/delete/{id}', 'WebinarController@delete');
    Route::any('webinar/detail/{id}', 'WebinarController@detail');
}
Route::any('attachment/download/{id}', 'AttachmentController@download');
Route::any('login/logout', 'LoginController@logout');
Route::any('course/join/{id}', 'CourseController@join');
Route::any('webinar/join/{id}', 'WebinarController@join');
Route::any('webinar/webinars', 'WebinarController@webinars');
Route::any('webinar/start/{id}', 'WebinarController@start');
Route::any('access_denied', 'AccessDeniedController@index');
Route::any('accessdenied', 'AccessDeniedController@index');Route::any('login/logout', 'LoginController@logout');
Route::any('forum/detilforum/{id}', 'ForumController@detail');
Route::any('comment/create/{id}', 'CommentController@create');

Route::any('register', 'UserInfoController@register');
Route::any('userinfo/active/{id}', 'UserInfoController@active');
Route::any('course/dashboard/{id}', 'CourseController@dashboard');
Route::any('quiz/take/{id}', 'QuizController@take');
Route::any('quiz/result/{id}', 'StudentQuizController@result');