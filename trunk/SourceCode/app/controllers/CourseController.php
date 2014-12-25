<?php

class CourseController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Course Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'CourseController@Index');
	|
	*/
    private $CourseService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $CourseList = $this->CourseService->getList();
        $this->data['CourseList'] = $CourseList;
        return View::make("course\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("course\input", $this->data);
    }
    
    private function bindData($param) {
        $Course = new Course();
        
        return $Course;
    }
    
    private function loadDefaultService() {
        $this->CourseService = new CourseService();
    }
}
