<?php

class CommentController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Comment Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'UserInfoController@Index');
	|
	*/
    private $CommentService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $CommentList = $this->CommentService->getList();
        $this->data['CommentList'] = $CommentList;
        return View::make("comment\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("comment\input", $this->data);
    }
    
    private function bindData($param) {
        $Comment = new Comment();
        
        return $Comment;
    }
    
    private function loadDefaultService() {
        $this->CommentService = new CommentService();
    }
}
?>