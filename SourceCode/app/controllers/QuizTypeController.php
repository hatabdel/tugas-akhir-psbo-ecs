<?php

class QuizTypeController extends BaseController {
    
    private $QuizTypeService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $QuizTypeList = $this->QuizTypeService->getList();
        $this->data['QuizTypeList'] = $QuizTypeList;
        return View::make("quiztype/index", $this->data);
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
                    $result = $this->QuizTypeService->InsertQuizType($model);
                    if (!$result) {
                        $this->addErrors($this->QuizTypeService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("quiztype/detail/".$model->getQuizType());
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
        
        $model = $this->QuizTypeService->getQuizType($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->QuizTypeService->UpdateQuizType($model, $model->getQuizType());
                    if (!$result) {
                        $this->addErrors($this->QuizTypeService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("quiztype/detail/".$model->getQuizType());
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
            $model = $this->QuizTypeService->getQuizType($id);
            if (is_null($model)) { return Redirect::to("quiztype"); }
            $this->QuizTypeService->DeleteQuizType($id);
            return Redirect::to("quiztype");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("quiztype");//var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->QuizTypeService->getQuizType($id);
        return View::make("quiztype/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new QuizType();
        }
        if ($mode == "create") {
            $this->data["action"] = "/quiztype/".$mode;
        } else {
            $this->data["action"] = "/quiztype/".$mode."/".(!is_null($model) ? $model->getQuizType() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("quiztype/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "name" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
	   $QuizTypeObj = new QuizType();
        if (!is_null($param) && count($param) > 0) {
            $QuizTypeObj->setQuizType($param["id"]);
            $QuizTypeObj->setName($param["name"]);
        }
        return $QuizTypeObj;
		
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
        $this->data["_MODULE_NAME"] = "Quiz Type - ";
    }
    
    private function loadDefaultService() {
        $this->QuizTypeService = new QuizTypeService();
    }
}
