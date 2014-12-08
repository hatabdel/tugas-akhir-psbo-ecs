<?php

class FunctionInfoController extends BaseController {
    
    private $FunctionInfoService;
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        return View::make("functioninfo/index");
    }
    
    public function create() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model);
                } else {
                    
                }
            }
        
            return View::make("functioninfo/input");
        } catch (Exception $ex) {
            //return $this->createInputView($model);
        }
    }
    
    private function createInputView() {
        /*if (!is_null($model))
            $this->data["model"] = $model;*/
        
        return View::make("functioninfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "url" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $FuntionInfoObj = new FunctionInfo();
        $FuntionInfoObj->setUrl($param["url"]);
        $FuntionInfoObj->setIsActive($param["is_active"]);
        $FuntionInfoObj->setIsShow($param["is_show"]);
        return $FuntionInfoObj;
    }
    
    private function loadDefaultValue() {
        
    }
    
    private function loadDefaultService() {
        $this->FunctionInfoService = new FunctionInfoService();
    }
}
