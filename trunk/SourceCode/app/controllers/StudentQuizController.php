<?php

class StudentQuizController extends BaseController {
    
    private $StudentQuizService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $StudentQuizList = $this->StudentQuizService->getList();
        $this->data['StudentQuizList'] = $StudentQuizList;
        return View::make("studentquiz/index", $this->data);
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
                    //$this->StudentQuizService->setStudentQuiz($this->mStudentQuiz);
                    $result = $this->StudentQuizService->InsertStudentQuiz($model);
                  if (!$result) {
                        $this->addErrors($this->StudentQuizService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("studentquiz/detail/".$model->getStudentQuiz());
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
        
        $model = $this->StudentQuizService->getStudentQuiz($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->StudentQuizService->UpdateStudentQuiz($model, $model->getStudentQuiz());
                     if (!$result) {
                        $this->addErrors($this->StudentQuizService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("studentquiz/detail/".$model->getStudentQuiz());
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
            $model = $this->StudentQuizService->getStudentQuiz($id);
            if (is_null($model)) { return Redirect::to("studentquiz"); }
            $this->StudentQuizService->DeleteStudentQuiz($id);
            return Redirect::to("studentquiz");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("studentquiz");//var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->StudentQuizService->getStudentQuiz($id);
        return View::make("studentquiz/detail", $this->data);
    }
    
    public function result($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->StudentQuizService->getStudentQuiz($id);
        return View::make("studentquiz/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new StudentQuiz();
        }
        if ($mode == "create") {
            $this->data["action"] = "/studentquiz/".$mode;
        } else {
            $this->data["action"] = "/studentquiz/".$mode."/".(!is_null($model) ? $model->getStudentQuiz() : "");
        } 
		
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
		$this->addErrorValidation($validation);
        return View::make("studentquiz/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "identity_id" => "required",
            "quiz_id" => "required",
            "total_score" => "required",
            "start_date_time" => "required",
            "end_date_time" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $StudentQuizObj = new StudentQuiz();
        if (!is_null($param) && count($param) > 0) {
			$StudentQuizObj->setStudentQuiz($param["id"]);
			$StudentQuizObj->setIdentity($param["identity_id"]);
			$StudentQuizObj->setQuiz($param["quiz_id"]);
			$StudentQuizObj->setTotalScore($param["total_score"]);
			$StudentQuizObj->setStartDateTime($param["start_date_time"]);
			$StudentQuizObj->setEndDateTime($param["end_date_time"]);
        }
        return $StudentQuizObj;
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
        $this->data["_MODULE_NAME"] = "Student Quiz - ";
    }
    
    private function loadDefaultService() {
        $this->StudentQuizService = new StudentQuizService();
    }
}
