<?php

class AttachmentController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Attachment Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'UserInfoController@Index');
	|
	*/
    private $AttachmentService = null;
    protected $function_id = "attachment";
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        return View::make("shared\commingsoon", $this->data);
        
        $AttachmentList = $this->AttachmentService->getList();
        $this->data['AttachmentList'] = $AttachmentList;
        return View::make("attachment\index", $this->data);
	}
    
    public function create()
	{
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        return View::make("shared\commingsoon", $this->data);
        
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("attachment\input", $this->data);
    }
    
    private function bindData($param) {
        $Attachment = new Attachment();
        
        return $Attachment;
    }
    
    private function loadDefaultService() {
        $this->AttachmentService = new AttachmentService();
    }
}
