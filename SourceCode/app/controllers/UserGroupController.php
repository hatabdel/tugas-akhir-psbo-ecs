<?php

class UserGroupController extends BaseController {
    
    private $UserGroupService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
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
        }
        return $UserGroupObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "User Group - ";
    }
    
    private function loadDefaultService() {
        $this->UserGroupService = new UserGroupService();
    }
}
