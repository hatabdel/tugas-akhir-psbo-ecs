<?php

class CourseDetailController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Course Detail Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'CourseDetailController@Index');
	|
	*/
    private $CourseDetailService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $CourseDetailList = $this->CourseDetailService->getList();
        $this->data['CourseDetailList'] = $CourseDetailList;
        return View::make("coursedetail\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("coursedetail\input", $this->data);
    }
    
    private function bindData($param) {
        $CourseDetail = new CourseDetail();
        
        return $CourseDetail;
    }
    
    private function loadDefaultService() {
        $this->CourseDetailService = new CourseDetailService();
    }
}
