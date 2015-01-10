<?php

class CommentController extends BaseController {
    
    private $CommentService;
    protected $function_id = "comment";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $CommentList = $this->CommentService->getList();
        $this->data['CommentList'] = $CommentList;
        return View::make("comment/index", $this->data);
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
					$this->CommentService->setUserInfo($this->mUserInfo);
                    $result = $this->CommentService->InsertComment($model);
                    if (!$result) {
                        $this->addErrors($this->CommentService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("comment/detail/".$model->getId());
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
        
        $model = $this->CommentService->getComment($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
					$this->CommentService->setUserInfo($this->mUserInfo);
                    $result = $this->CommentService->UpdateComment($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->CommentService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("comment/detail/".$model->getId());
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
            $model = $this->CommentService->getComment($id);
            if (is_null($model)) { return Redirect::to("comment"); }
            $this->CommentService->DeleteComment($id);
            return Redirect::to("comment");
        } catch (Exception $ex) {
			$this->addError($ex->getMessage());
            return Redirect::to("course");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->CommentService->getComment($id);
        return View::make("comment/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Comment();
        }
        if ($mode == "create") {
            $this->data["action"] = "/comment/".$mode;
        } else {
            $this->data["action"] = "/comment/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        //$this->loadFunctionList();
        //$this->loadUsertGroupList();
		
        $this->addErrorValidation($validation);
        return View::make("comment/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "content" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $CommentObj = new Comment();
        if (!is_null($param) && count($param) > 0) {
            $CommentObj->setId($param["id"]);
			$CommentObj->setTitle($param["title"]);
			$CommentObj->setContent($param["content"]);
			
        }
        return $CommentObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Comment - ";
    }
    
    private function loadDefaultService() {
        $this->CommentService = new CommentService();
    }
}
