<?php

class PrivilegeInfoController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Privilege Info Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'PrivilegeInfoController@Index');
	|
	*/
    private $PrivilegeInfoService = null;
    
    public function __construct() {
       parent::__construct();
       $this->loadDefaultService();
    }
   
	public function index()
	{
        $PrivilegeInfoList = $this->PrivilegeInfoService->getList();
        $this->data['PrivilegeInfoList'] = $PrivilegeInfoList;
        return View::make("privilegeinfo\index", $this->data);
	}
    
    public function create()
	{
        $param = Input::all();
        $model = $this->bindData($param);
        return $this->createInputView($model);
	}
    
    private function createInputView($model) {
        $this->data['model'] = $model;
        return View::make("privilegeinfo\input", $this->data);
    }
    
    private function bindData($param) {
        $PrivilegeInfo = new PrivilegeInfo();
        
        return $PrivilegeInfo;
    }
    
    private function loadDefaultService() {
        $this->PrivilegeInfoService = new PrivilegeInfoService();
    }
}
