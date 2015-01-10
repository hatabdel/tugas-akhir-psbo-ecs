<?php

class AccessDeniedController extends BaseController {
    
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