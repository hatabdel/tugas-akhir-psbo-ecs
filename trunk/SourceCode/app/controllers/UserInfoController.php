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
                    $result = $this->UserInfoService->InsertUserInfo($model);
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("userinfo/detail/".$model->getFunctionId());
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
                    $result = $this->UserInfoService->UpdateUserInfo($model, $model->getFunctionId());
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("userinfo/detail/".$model->getFunctionId());
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
            $this->data["action"] = "/userinfo/".$mode."/".(!is_null($model) ? $model->getFunctionId() : "");
        }
        
        $this->addErrorValidation($validation);
        return View::make("userinfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "function_id" => "required",
            "url" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $UserInfoObj = new UserInfo();
        if (!is_null($param) && count($param) > 0) {
            $UserInfoObj->setUserName($param["function_id"]);
            $UserInfoObj->setUrl($param["url"]);
            $UserInfoObj->setIsActive($param["is_active"]);
            $UserInfoObj->setIsShow($param["is_show"]);
        }
        return $UserInfoObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "User Info - ";
    }
    
    private function loadDefaultService() {
        $this->UserInfoService = new UserInfoService();
    }
}
