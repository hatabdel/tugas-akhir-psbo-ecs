<?php

class UserInfoController extends BaseController {
    
    private $UserInfoService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $UserInfoList = $this->UserInfoService->getList();
        $this->data['UserInfoList'] = $UserInfoList;
        return View::make("userinfo/index", $this->data);
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
                    $this->UserInfoService->setUserInfo($this->mUserInfo);
                    $result = $this->UserInfoService->InsertUserInfo($model);
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("userinfo/detail/".$model->getUserName());
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
        
        $model = $this->UserInfoService->getUserInfo($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->UserInfoService->UpdateUserInfo($model, $model->getUserName());
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("userinfo/detail/".$model->getUserName());
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
            $model = $this->UserInfoService->getUserInfo($id);
            if (is_null($model)) { return Redirect::to("userinfo"); }
            $this->UserInfoService->DeleteUserInfo($id);
            return Redirect::to("userinfo");
        } catch (Exception $ex) {
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->UserInfoService->getUserInfo($id);
        return View::make("userinfo/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new UserInfo();
        }
        if ($mode == "create") {
            $this->data["action"] = "/userinfo/".$mode;
        } else {
            $this->data["action"] = "/userinfo/".$mode."/".(!is_null($model) ? $model->getUserName() : "");
        }
        
        $this->loadUserGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("userinfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "user_name" => "required",
            "password" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $UserInfoObj = new UserInfo();
        if (!is_null($param) && count($param) > 0) {
            $UserInfoObj->setUserName($param["user_name"]);
            $UserInfoObj->setPassword($param["password"]);
            $UserInfoObj->setIsActive($param["is_active"]);
            $UserInfoObj->setUserGroup($param["user_group_id"]);
        }
        return $UserInfoObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "User Info - ";
    }
    
    private function loadUserGroupList() {
        $UserGroupService = new UserGroupService();
        $UserGroupList = $UserGroupService->getList();
        $this->data['UserGroupList'] = $UserGroupList;
    }
    
    private function loadDefaultService() {
        $this->UserInfoService = new UserInfoService();
    }
}
