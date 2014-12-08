<?php

class BaseController extends Controller {

	
    protected $login_url;
    protected $access_denied_url;
    protected $data;
    
    public function __construct() {
        $this->setupLayout();
        $this->login_url = url();
        $this->access_denied_url = url();    
    }
    
    /*
	 * Setup the layout used by the controller.
	 * @return void
	 */
    protected function setupLayout()
	{
        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    
    protected function IsLogin() {
        return true;
    }
    
    protected function IsAllowRead() {
        return true;
    }
    
    protected function IsAllowCreate() {
        return true;
    }
    
    protected function IsAllowUpdate() {
        return true;
    }
    
    protected function IsAllowDelete() {
        return true;
    }
    
    protected function addError($err) {
        
    }
    
    protected function addErrors($arr_err) {
        
    }
    
    protected function getErrors() {
        
    }

}
