<?php

class AnswerController extends BaseController {
    
    private $AnswerService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $AnswerList = $this->AnswerService->getList();
        $this->data['AnswerList'] = $AnswerList;
        return View::make("answer/index", $this->data);
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
                    $result = $this->AnswerService->InsertAnswer($model);
                    if (!$result) {
                        $this->addErrors($this->AnswerService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("answer/detail/".$model->getId());
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
        
        $model = $this->AnswerService->getAnswer($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->AnswerService->UpdateAnswer($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->AnswerService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("answer/detail/".$model->getId());
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
            $model = $this->AnswerService->getAnswer($id);
            if (is_null($model)) { return Redirect::to("answer"); }
            $this->AnswerService->DeleteAnswer($id);
            return Redirect::to("answer");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("answer");//var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->AnswerService->getAnswer($id);
        return View::make("answer/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Answer();
        }
        if ($mode == "create") {
            $this->data["action"] = "/answer/".$mode;
        } else {
            $this->data["action"] = "/answer/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
		
        $this->addErrorValidation($validation);
        return View::make("answer/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "sequence" => "required",
            "quiz_question_id" => "required",
            "content" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
	   $AnswerObj = new Answer();
        if (!is_null($param) && count($param) > 0) {
            $AnswerObj->setId($param["id"]);
            $AnswerObj->setSequence($param["sequence"]);
            $AnswerObj->setQuizQuestionId($param["quiz_question_id"]);
            $AnswerObj->setContent($param["content"]);
            $AnswerObj->setIsCorrect($param["is_correct"]);
        }
        return $AnswerObj;
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
        $this->data["_MODULE_NAME"] = "Answer - ";
    }
    
    private function loadDefaultService() {
        $this->AnswerService = new AnswerService();
    }
}
