<?php

class UserGroupController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default User Info Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'UserInfoController@Index');
	|
	*/
    private $UserGroupService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $UserGroupList = $this->UserGroupService->getList();
        $this->data['UserGroupList'] = $UserGroupList;
        return View::make("usergroup\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("usergroup\input", $this->data);
    }
    
    private function bindData($param) {
        $UserGroup = new UserGroup();
        
        return $UserGroup;
    }
    
    private function loadDefaultService() {
        $this->UserGroupService = new UserGroupService();
    }
}
