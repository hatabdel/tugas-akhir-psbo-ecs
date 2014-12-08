<?php

class UserInfoController extends BaseController {

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
    private $UserInfoService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $UserInfoList = $this->UserInfoService->getList();
        $this->data['UserInfoList'] = $UserInfoList;
        return View::make("userinfo\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("userinfo\input", $this->data);
    }
    
    private function bindData($param) {
        $UserInfo = new UserInfo();
        
        return $UserInfo;
    }
    
    private function loadDefaultService() {
        $this->UserInfoService = new UserInfoService();
    }
}
