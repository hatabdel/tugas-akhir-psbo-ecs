<?php

class QuizTypeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Quiz Type Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'QuizTypeController@Index');
	|
	*/
    private $QuizTypeService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $QuizTypeList = $this->QuizTypeService->getList();
        $this->data['QuizTypeList'] = $QuizTypeList;
        return View::make("quiztype\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("quiztype\input", $this->data);
    }
    
    private function bindData($param) {
        $QuizType = new QuizType();
        
        return $QuizType;
    }
    
    private function loadDefaultService() {
        $this->QuizTypeService = new QuizTypeService();
    }
}
