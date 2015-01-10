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
    protected $function_id = "course_detail";
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        return View::make("shared\commingsoon", $this->data);
        
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
