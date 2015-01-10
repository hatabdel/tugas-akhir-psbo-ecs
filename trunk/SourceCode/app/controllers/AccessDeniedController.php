<?php

class AccessDeniedController extends BaseController {
    
    protected $function_id = "access_denied";
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        return View::make("accessdenied/index", $this->data);
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Access Denied - ";
    }
    
}