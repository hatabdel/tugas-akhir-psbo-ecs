<?php

class QuizQuestionController extends BaseController {
    
    private $QuizQuestionService;
    protected $function_id = "quiz_question";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $QuizQuestionList = $this->QuizQuestionService->getList();
        $this->data['QuizQuestionList'] = $QuizQuestionList;
        return View::make("quizquestion/index", $this->data);
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
                    $result = $this->QuizQuestionService->InsertQuizQuestion($model);
                    if (!$result) {
                        $this->addErrors($this->QuizQuestionService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("quizquestion/detail/".$model->getId());
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
        
        $model = $this->QuizQuestionService->getQuizQuestion($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->QuizQuestionService->UpdateQuizQuestion($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->QuizQuestionService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("quizquestion/detail/".$model->getId());
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
            $model = $this->QuizQuestionService->getQuizQuestion($id);
            if (is_null($model)) { return Redirect::to("quizquestion"); }
            $this->QuizQuestionService->DeleteQuizQuestion($id);
            return Redirect::to("quizquestion");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->QuizQuestionService->getQuizQuestion($id);
        return View::make("quizquestion/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new QuizQuestion();
        }
        if ($mode == "create") {
            $this->data["action"] = "/quizquestion/".$mode;
        } else {
            $this->data["action"] = "/quizquestion/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
		
        $this->addErrorValidation($validation);
        return View::make("quizquestion/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
           // "quiz_question_id" => "required",
            "quiz_id" => "required",
            "question" => "required",
            "answer_type_id" => "required",
            "score" => "required"
            //"is_correct" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
	   $QuizQuestionObj = new QuizQuestion();
        if (!is_null($param) && count($param) > 0) {
            $QuizQuestionObj->setId($param["id"]);
            $QuizQuestionObj->setQuiz($param["quiz_id"]);
            $QuizQuestionObj->setQuestion($param["question"]);
            $QuizQuestionObj->setAnswerType($param["answer_type_id"]);
            $QuizQuestionObj->setScore($param["score"]);
        }
        return $QuizQuestionObj;
		
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
        $this->data["_MODULE_NAME"] = "Quiz Question - ";
    }
    
    private function loadDefaultService() {
        $this->QuizQuestionService = new QuizQuestionService();
    }
}
