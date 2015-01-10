<?php

class UserGroupController extends BaseController {
    
    private $UserGroupService;
    protected $function_id = "user_group";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $UserGroupList = $this->UserGroupService->getList();
        $this->data['UserGroupList'] = $UserGroupList;
        return View::make("usergroup/index", $this->data);
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
                    $result = $this->UserGroupService->InsertUserGroup($model);
                    if (!$result) {
                        $this->addErrors($this->UserGroupService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("usergroup/detail/".$model->getId());
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
        
        $model = $this->UserGroupService->getUserGroup($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->UserGroupService->UpdateUserGroup($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->UserGroupService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("usergroup/detail/".$model->getId());
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
            $model = $this->UserGroupService->getUserGroup($id);
            if (is_null($model)) { return Redirect::to("usergroup"); }
            $this->UserGroupService->DeleteUserGroup($id);
            return Redirect::to("usergroup");
        } catch (Exception $ex) {
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->UserGroupService->getUserGroup($id);
        return View::make("usergroup/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new UserGroup();
        }
        if ($mode == "create") {
            $this->data["action"] = "/usergroup/".$mode;
        } else {
            $this->data["action"] = "/usergroup/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadFunctionList();
        $this->addErrorValidation($validation);
        return View::make("usergroup/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "name" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $UserGroupObj = new UserGroup();
        if (!is_null($param) && count($param) > 0) {
            $UserGroupObj->setId($param["id"]);
            $UserGroupObj->setName($param["name"]);
            $PrivilegeInfos = $this->bindDataPrivilegeInfo($param);
            $UserGroupObj->setPrivilegeInfos($PrivilegeInfos);
        }
        return $UserGroupObj;
    }
    
    private function bindDataPrivilegeInfo($param) {
        $PrivilegesInfos = array();
        $arr_Details = $param["details"];
        $arr_PrivilgeInfoId = $param["privilege_info_id"];
        $arr_FunctionInfoId = $param["function_info"];
        $arr_IsAllowRead = $param["is_allow_read"];
        $arr_IsAllowCreate = $param["is_allow_create"];
        $arr_IsAllowUpdate = $param["is_allow_update"];
        $arr_IsAllowDelete = $param["is_allow_delete"];
        
        if (count($arr_Details) > 0) {
            for($i = 0;$i < count($arr_Details);$i++) {
                $PrivilegeInfoObj = new PrivilegeInfo();
                $PrivilegeInfoObj->setId($arr_PrivilgeInfoId[$i]);
                $FunctionInfoObj = new FunctionInfo();
                $FunctionInfoObj->setFunctionId($arr_FunctionInfoId[$i]);
                $FunctionInfoObj->setIsLoaded(true);
                $PrivilegeInfoObj->setFunctionInfo($FunctionInfoObj);
                $PrivilegeInfoObj->setIsAllowRead($arr_IsAllowRead[$i]);
                $PrivilegeInfoObj->setIsAllowCreate($arr_IsAllowCreate[$i]);
                $PrivilegeInfoObj->setIsAllowUpdate($arr_IsAllowUpdate[$i]);
                $PrivilegeInfoObj->setIsAllowDelete($arr_IsAllowDelete[$i]);
                $PrivilegeInfoObj->setIsLoaded(true);
                $PrivilegesInfos[] = $PrivilegeInfoObj;
            }
        }
        
        return $PrivilegesInfos;
    }
    
    private function loadFunctionList() {
        $FunctionInfoService = new FunctionInfoService();
        $FunctionInfoList = $FunctionInfoService->getList();
        $this->data['FunctionInfoList'] = $FunctionInfoList;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "User Group - ";
    }
    
    private function loadDefaultService() {
        $this->UserGroupService = new UserGroupService();
    }
}
