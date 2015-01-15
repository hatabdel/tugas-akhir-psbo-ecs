<?php

class FunctionInfoController extends BaseController {
    
    private $FunctionInfoService;
    protected $function_id = "function_info";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $FunctionInfoList = $this->FunctionInfoService->getList();
        $this->data['FunctionInfoList'] = $FunctionInfoList;
        return View::make("functioninfo/index", $this->data);
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
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->FunctionInfoService->InsertFunctionInfo($model);
                    if (!$result) {
                        $this->addErrors($this->FunctionInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("functioninfo/detail/".$model->getFunctionId());
                }
            }
            return $this->createInputView($model);
        } catch (Exception $ex) {
            return $this->createInputView(null);
        }
    }
    
    public function edit($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowUpdate()) { return Redirect::to("access_denied"); }
        
        $model = $this->FunctionInfoService->getFunctionInfo($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->FunctionInfoService->UpdateFunctionInfo($model, $model->getFunctionId());
                    if (!$result) {
                        $this->addErrors($this->FunctionInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("functioninfo/detail/".$model->getFunctionId());
                }
            }
            return $this->createInputView($model, null, "edit");
        } catch (Exception $ex) {
            return $this->createInputView(null, null, "edit");
        }
    }
    
    public function delete($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowDelete()) { return Redirect::to("access_denied"); }
        try {
            $model = $this->FunctionInfoService->getFunctionInfo($id);
            if (is_null($model)) { return Redirect::to("functioninfo"); }
            $this->FunctionInfoService->DeleteFunctionInfo($id);
            return Redirect::to("functioninfo");
        } catch (Exception $ex) {
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->FunctionInfoService->getFunctionInfo($id);
        return View::make("functioninfo/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new FunctionInfo();
        }
        if ($mode == "create") {
            $this->data["action"] = "/functioninfo/".$mode;
        } else {
            $this->data["action"] = "/functioninfo/".$mode."/".(!is_null($model) ? $model->getFunctionId() : "");
        }
        
        $this->loadModuleInfoList();
        $this->loadIconList();
        $this->addErrorValidation($validation);
        return View::make("functioninfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "function_id" => "required",
            "name" => "required",
            "url" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $FuntionInfoObj = new FunctionInfo();
        if (!is_null($param) && count($param) > 0) {
            $FuntionInfoObj->setFunctionId($param["function_id"]);
            $FuntionInfoObj->setName($param["name"]);
            $FuntionInfoObj->setUrl($param["url"]);
            $FuntionInfoObj->setRoute($param["route"]);
            $FuntionInfoObj->setIcon($param["icon"]);
            $ModuleInfo = new ModuleInfo();
            $ModuleInfo->setId($param["module_info_id"]);
            $ModuleInfo->setIsLoaded(true);
            $FuntionInfoObj->setModuleInfo($ModuleInfo);
            $FuntionInfoObj->setIsActive($param["is_active"]);
            $FuntionInfoObj->setIsShow($param["is_show"]);
        }
        return $FuntionInfoObj;
    }
    
    private function loadModuleInfoList() {
        $ModuleInfoService = new ModuleInfoService();
        $ModuleInfoList = $ModuleInfoService->getList();
        $this->data['ModuleInfoList'] = $ModuleInfoList;
    }
    
    private function loadIconList() {
        $IconService = new IconService();
        $IconList = $IconService->getList();
        $this->data['IconList'] = $IconList;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Function Info - ";
    }
    
    private function loadDefaultService() {
        $this->FunctionInfoService = new FunctionInfoService();
    }
}
