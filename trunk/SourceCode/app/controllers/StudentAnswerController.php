<?php

class StudentAnswerController extends BaseController {
    
    private $StudentAnswerService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $StudentAnswerList = $this->StudentAnswerService->getList();
        $this->data['StudentAnswerList'] = $StudentAnswerList;
        return View::make("studentanswer/index", $this->data);
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
                    $result = $this->StudentAnswerService->InsertStudentAnswer($model);
                    if (!$result) {
                        $this->addErrors($this->StudentAnswerService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("studentanswer/detail/".$model->getStudentAnswerId());
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
        
        $model = $this->StudentAnswerService->getStudentAnswer($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->StudentAnswerService->UpdateStudentAnswer($model, $model->getStudentAnswerId());
                    if (!$result) {
                        $this->addErrors($this->StudentAnswerService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("studentanswer/detail/".$model->getStudentAnswerId());
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
            $model = $this->StudentAnswerService->getStudentAnswer($id);
            if (is_null($model)) { return Redirect::to("studentanswer"); }
            $this->StudentAnswerService->DeleteStudentAnswer($id);
            return Redirect::to("studentanswer");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("studentanswer");// var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->StudentAnswerService->getStudentAnswer($id);
        return View::make("studentanswer/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new StudentAnswer();
        }
        if ($mode == "create") {
            $this->data["action"] = "/studentanswer/".$mode;
        } else {
            $this->data["action"] = "/studentanswer/".$mode."/".(!is_null($model) ? $model->getStudentAnswerId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("studentanswer/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            //"student_answer_id" => "required",
            "student_quiz_id" => "required",
            "quiz_question_id" => "required",
            "student_answer" => "required",
            "score" => "required"
            //"is_correct" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
	   $StudentAnswerObj = new StudentAnswer();
        if (!is_null($param) && count($param) > 0) {
            $StudentAnswerObj->setStudentAnswerId($param["student_answer_id"]);
            $StudentAnswerObj->setStudentQuizId($param["student_quiz_id"]);
            $StudentAnswerObj->setQuizQuestionId($param["quiz_question_id"]);
            $StudentAnswerObj->setStudentAnswer($param["student_answer"]);
            $StudentAnswerObj->setScore($param["score"]);
            $StudentAnswerObj->setIsCorrect($param["is_correct"]);
        }
        return $StudentAnswerObj;
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
        $this->data["_MODULE_NAME"] = "Student Answer - ";
    }
    
    private function loadDefaultService() {
        $this->StudentAnswerService = new StudentAnswerService();
    }
}
