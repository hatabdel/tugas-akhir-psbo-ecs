<?php

class BaseController extends Controller {

	
    protected $login_url;
    protected $access_denied_url;
    protected $data;
    protected $errors = array();
    
    public function __construct() {
        $this->setupLayout();
        $this->login_url = url();
        $this->access_denied_url = url();
        $this->data["errors"] = "";
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
    if (is_null($err) || empty($err)) { return; }
        $this->errors[] = '<li>'.$err.'</li>';
        $this->getErrors();
    }
    
    protected function addErrorValidation($errors) {
        if (is_null($errors)) { return; }
        foreach ($errors->all('<li>:message</li>') as $message)
        {
            $this->errors[] = $message;
        }
        
        $this->getErrors();
    }
    
    protected function addErrors($arr_err) {
        
    }
    
    protected function getErrors() {
        if (!is_null($this->errors) && count($this->errors) > 0) {
            $this->data["errors"] = "<div class=\"alert alert-danger\" role=\"alert\">";
            foreach($this->errors as $error) {
                $this->data["errors"] .= $error;
            }
            $this->data["errors"] .= "</div>";
        }
    }

}
