<?php

class ModuleInfoController extends BaseController {
    
    private $ModuleInfoService;
    protected $function_id = "module_info";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $ModuleInfoList = $this->ModuleInfoService->getList();
        $this->data['ModuleInfoList'] = $ModuleInfoList;
        return View::make("moduleinfo/index", $this->data);
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
                    $result = $this->ModuleInfoService->InsertModuleInfo($model);
                    if (!$result) {
                        $this->addErrors($this->ModuleInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("moduleinfo/detail/".$model->getId());
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
        
        $model = $this->ModuleInfoService->getModuleInfo($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->ModuleInfoService->UpdateModuleInfo($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->ModuleInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("moduleinfo/detail/".$model->getId());
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
            $model = $this->ModuleInfoService->getModuleInfo($id);
            if (is_null($model)) { return Redirect::to("moduleinfo"); }
            $this->ModuleInfoService->DeleteModuleInfo($id);
            return Redirect::to("moduleinfo");
        } catch (Exception $ex) {
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->ModuleInfoService->getModuleInfo($id);
        return View::make("moduleinfo/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new ModuleInfo();
        }
        if ($mode == "create") {
            $this->data["action"] = "/moduleinfo/".$mode;
        } else {
            $this->data["action"] = "/moduleinfo/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadIconList();
        $this->addErrorValidation($validation);
        return View::make("moduleinfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "name" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $ModuleInfoObj = new ModuleInfo();
        if (!is_null($param) && count($param) > 0) {
            $ModuleInfoObj->setId($param["id"]);
            $ModuleInfoObj->setName($param["name"]);
            $ModuleInfoObj->setIcon($param["icon"]);
        }
        return $ModuleInfoObj;
    }
    
    private function loadIconList() {
        $IconService = new IconService();
        $IconList = $IconService->getList();
        $this->data['IconList'] = $IconList;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Module Info - ";
    }
    
    private function loadDefaultService() {
        $this->ModuleInfoService = new ModuleInfoService();
    }
}
