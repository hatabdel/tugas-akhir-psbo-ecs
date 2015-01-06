<?php

class PrivilegeInfoController extends BaseController {
    
    private $PrivilegeInfoService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $PrivilegeInfoList = $this->PrivilegeInfoService->getList();
        $this->data['PrivilegeInfoList'] = $PrivilegeInfoList;
        return View::make("privilegeinfo/index", $this->data);
    }
    
    public function create() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        try {
            $input = Input::all();
            $model = null;
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->PrivilegeInfoService->InsertPrivilegeInfo($model);
                    if (!$result) {
                        $this->addErrors($this->PrivilegeInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("privilegeinfo/detail/".$model->getId());
                }
            }
            return $this->createInputView($model);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null);
        }
    }
    
    public function edit($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowUpdate()) { return Redirect::to("access_denied"); }
        
        $model = $this->PrivilegeInfoService->getPrivilegeInfo($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->PrivilegeInfoService->UpdatePrivilegeInfo($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->PrivilegeInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("privilegeinfo/detail/".$model->getId());
                }
            }
            return $this->createInputView($model, null, "edit");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null, null, "edit");
        }
    }
    
    public function delete($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowDelete()) { return Redirect::to("access_denied"); }
        try {
            $model = $this->PrivilegeInfoService->getPrivilegeInfo($id);
            if (is_null($model)) { return Redirect::to("privilegeinfo"); }
            $this->PrivilegeInfoService->DeletePrivilegeInfo($id);
            return Redirect::to("privilegeinfo");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("privilegeinfo");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->PrivilegeInfoService->getPrivilegeInfo($id);
        return View::make("privilegeinfo/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new PrivilegeInfo();
        }
        if ($mode == "create") {
            $this->data["action"] = "/privilegeinfo/".$mode;
        } else {
            $this->data["action"] = "/privilegeinfo/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("privilegeinfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "function_id" => "required",
            "user_group_id" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $PrivilegeInfoObj = new PrivilegeInfo();
        if (!is_null($param) && count($param) > 0) {
            $PrivilegeInfoObj->setId($param["id"]);
            $FunctionInfoObj = new FunctionInfo();
            $FunctionInfoObj->setFunctionId($param["function_id"]);
            $FunctionInfoObj->setIsLoaded(true);
            $PrivilegeInfoObj->setFunctionInfo($FunctionInfoObj);
            $UserGroupObj = new UserGroup();
            $UserGroupObj->setId($param["user_group_id"]);
            $UserGroupObj->setIsLoaded(true);
            $PrivilegeInfoObj->setUserGroup($UserGroupObj);
            $PrivilegeInfoObj->setIsAllowRead($param["is_allow_read"]);
            $PrivilegeInfoObj->setIsAllowCreate($param["is_allow_create"]);
            $PrivilegeInfoObj->setIsAllowUpdate($param["is_allow_update"]);
            $PrivilegeInfoObj->setIsAllowDelete($param["is_allow_delete"]);
        }
        return $PrivilegeInfoObj;
    }
    
    private function loadFunctionList() {
        $FunctionInfoService = new FunctionInfoService();
        $FunctionInfoList = $FunctionInfoService->getList();
        $this->data['FunctionInfoList'] = $FunctionInfoList;
    }

    private function loadUsertGroupList() {
        $UserGroupService = new UserGroupService();
        $UserGroupList = $UserGroupService->getList();
        $this->data['UserGroupList'] = $UserGroupList;
    }
    

    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Privilege Info - ";
    }
    
    private function loadDefaultService() {
        $this->PrivilegeInfoService = new PrivilegeInfoService();
    }
}
