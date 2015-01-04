<?php

class ForumController extends BaseController {
    
    private $ForumService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $ForumList = $this->ForumService->getList();
        $this->data['ForumList'] = $ForumList;
        return View::make("forum/index", $this->data);
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
					$this->ForumService->setUserInfo($this->mUserInfo);
                    $result = $this->ForumService->InsertForum($model);
                    if (!$result) {
                        $this->addErrors($this->ForumService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("forum/detail/".$model->getId());
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
        
        $model = $this->ForumService->getForum($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
					$this->ForumService->setUserInfo($this->mUserInfo);
                    $result = $this->ForumService->UpdateForum($model, $model->getId());
					if (!$result) {
                        $this->addErrors($this->ForumService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("forum/detail/".$model->getId());
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
            $model = $this->ForumService->getForum($id);
            if (is_null($model)) { return Redirect::to("forum"); }
            $this->ForumService->DeleteForum($id);
            return Redirect::to("forum");
        } catch (Exception $ex) {
			$this->addError($ex->getMessage());
            return Redirect::to("forum");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->ForumService->getForum($id);
        return View::make("forum/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Forum();
        }
        if ($mode == "create") {
            $this->data["action"] = "/forum/".$mode;
        } else {
            $this->data["action"] = "/forum/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
		//$this->loadFunctionList();
        //$this->loadUsertGroupList();
		
        $this->addErrorValidation($validation);
        return View::make("forum/input", $this->data);
    }
    
	private function initValidation() {
        $form_validation = array(
            "title" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $ForumObj = new Forum();
        if (!is_null($param) && count($param) > 0) {
            $ForumObj->setId($param["id"]);
            $ForumObj->setTitle($param["title"]);
			$ForumObj->setContent($param["content"]);
			$ForumObj->setIsPublic($param["is_public"]);
			
        }
        return $ForumObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Forum - ";
    }
    
    private function loadDefaultService() {
        $this->ForumService = new ForumService();
    }
}
