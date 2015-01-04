<?php

class QuizController extends BaseController {
    
    private $QuizService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $QuizList = $this->QuizService->getList();
        $this->data['QuizList'] = $QuizList;
        return View::make("quiz/index", $this->data);
    }
    
    public function create() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowCreate()) { return Redirect::to("access_denied"); }
        
        try {
            $input = Input::all();
            $model = null;
            if (count($input) > 0) {
                $model = $this->bindData($input);//var_dump($model); die();
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->QuizService->InsertQuiz($model);
                   if (!$result) {
                        $this->addErrors($this->QuizService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("quiz/detail/".$model->getQuizId());
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
        
        $model = $this->QuizService->getQuiz($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->QuizService->UpdateQuiz($model, $model->getQuizId());
                    if (!$result) {
                        $this->addErrors($this->QuizService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("quiz/detail/".$model->getQuizId());
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
            $model = $this->QuizService->getQuiz($id);
            if (is_null($model)) { return Redirect::to("quiz"); }
            $this->QuizService->DeleteQuiz($id);
            return Redirect::to("quiz");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("quiz");//var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->QuizService->getQuiz($id);
        return View::make("quiz/detail", $this->data);
    }
 
	    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Quiz();
        }
        if ($mode == "create") {
            $this->data["action"] = "/quiz/".$mode;
        } else {
            $this->data["action"] = "/quiz/".$mode."/".(!is_null($model) ? $model->getQuizId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("quiz/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "quiz_name" => "required",
            "course_code" => "required",
            "quiz_type_id" => "required",
            "start_date_time" => "required",
            "end_date_time" => "required",
            "created_date" => "required",
            "created_user" => "required",
            "update_date" => "required",
            "update_user" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $QuizObj = new Quiz();
        if (!is_null($param) && count($param) > 0) {
			$QuizObj->setQuizId($param["quiz_id"]);
			$QuizObj->setQuizName($param["quiz_name"]);
			$QuizObj->setCourseCode($param["course_code"]);
			$QuizObj->setQuizTypeId($param["quiz_type_id"]);
			$QuizObj->setStartDateTime($param["start_date_time"]);
			$QuizObj->setEndDateTime($param["end_date_time"]);
			$QuizObj->setCreatedDate($param["created_date"]);
			$QuizObj->setCreatedUser($param["created_user"]);
			$QuizObj->setUpdateDate($param["update_date"]);
			$QuizObj->setUpdateUser($param["update_user"]);
        }
        return $QuizObj;
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
        $this->data["_MODULE_NAME"] = "Quiz - ";
    }
    
    private function loadDefaultService() {
        $this->QuizService = new QuizService();
    }
}
