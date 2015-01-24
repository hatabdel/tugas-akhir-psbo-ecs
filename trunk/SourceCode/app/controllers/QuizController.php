<?php

class QuizController extends BaseController {
    
    private $QuizService;
    protected $function_id = "quiz";
    private $Course = null;
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
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
            if (count($input) > 0 && Request::isMethod('post')) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages());
                } else {
                    $result = $this->QuizService->InsertQuiz($model);
                   if (!$result) {
                        $this->addErrors($this->QuizService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("quiz/detail/".$model->getId());
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
                    $result = $this->QuizService->UpdateQuiz($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->QuizService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("quiz/detail/".$model->getId());
                }
            }
            return $this->createInputView($model, null, "edit");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null, null, "edit");
        }
    }
    
    public function take($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $model = $this->QuizService->getQuiz($id);
        if (!$this->checkQuizValidation($model)) {
            $this->SaveModelStateTemp();
            return Redirect::to("quiz/detail/".$id);
        }
        
        $minutes_interval = 0;
        if (!Session::has('quiz_start_time'))
        {
            
            $startTime = strtotime(Date("Y-m-d H:i:s"));
            
            $datetime1 = new DateTime($model->getEndDateTime());
            $datetime2 = new DateTime(Date("Y-m-d H:i:s"));
            $interval = date_diff($datetime1, $datetime2);
            
            $minutes_interval = $interval->format('%i');
            Session::put('quiz_start_time', $startTime);
        } else {
            $startTime = Session::get('quiz_start_time');
            
            $datetime1 = new DateTime($model->getEndDateTime());
            $datetime2 = new DateTime(Date("Y-m-d H:i:s", $startTime));
            $interval = date_diff($datetime1, $datetime2);
            $minutes_interval = $interval->format('%i');
        }
        
        $minutes = round($model->getQuizTime(),2) * 60;
        if ($minutes_interval < $minutes) {
            $minutes = $minutes_interval;
        }
        
        $this->data["maxTime"] = strtotime("+".$minutes." minutes", $startTime);
        
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $StudentQuizObj = $this->bindDataStudentQuiz($input, $id);
                $this->data["param"] = $input;
                $validation = Validator::make($input, $this->initTakeValidation());
                if ($validation->fails()) {
                    return $this->createTakeView($model, $validation->messages(), "take");
                } else {
                    $StudentQuizService = new StudentQuizService();
                    $StudentQuizService->setUserInfo($this->mUserInfo);
                    $StudentQuizObj->setStartDateTime(Date("Y-m-d H:i:s", $startTime));
                    $result = $StudentQuizService->InsertStudentQuiz($StudentQuizObj);
                    if (!$result) {
                        $this->addErrors($this->QuizService->getErrors());
                        return $this->createTakeView($model, $validation->messages(), "take");
                    }
                    if (Session::has('quiz_start_time')) {
                        Session::forget('quiz_start_time');
                    }
                    return Redirect::to("quiz/result/".$StudentQuizObj->getId());
                }
            }
            return $this->createTakeView($model, null, "take");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createTakeView(null, null, "take");
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
            return Redirect::to("quiz");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->GetModelStateFromTemp();
        $this->getErrors();
        $quizObj = $this->QuizService->getQuiz($id);
        if (is_null($quizObj)) { return Redirect::to("/"); }
        
        $StudentQuizService = new StudentQuizService();
        $StudentQuizFilter = new StudentQuizFilter();
        $StudentQuizFilter->setQuizId($quizObj->getId());
        if (!is_null($this->mUserInfo)) {
            $StudentQuizFilter->setUserName($this->mUserInfo->getUserName());
        }
        $StudentQuizs = $StudentQuizService->getList($StudentQuizFilter);
        $this->data["student_quiz"] = null;
        if (!is_null($StudentQuizs) && count($StudentQuizs) > 0) {
            $this->data["student_quiz"] = $StudentQuizs[0];
        }
        
        $this->data["model"] = $quizObj;
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
            $this->data["action"] = "/quiz/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        $this->loadCourseList();
        $this->loadQuizTypeList();
        
        $this->addErrorValidation($validation);
        return View::make("quiz/input2", $this->data);
    }
    
    private function createTakeView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Quiz();
        }
        if ($mode == "create") {
            $this->data["action"] = "/quiz/".$mode;
        } else {
            $this->data["action"] = "/quiz/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        
        $this->loadCourseList();
        $this->loadQuizTypeList();
        
        $this->addErrorValidation($validation);
        return View::make("quiz/take", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "quiz_name" => "required",
            "course_code" => "required",
            "quiz_type_id" => "required",
            "start_date_time" => "required",
            "end_date_time" => "required"
        );
        return $form_validation;
    }
    
    private function initTakeValidation() {
        $form_validation = array(
            
        );
        return $form_validation;
    }
    
    private function checkQuizValidation($quizObj) {
        if (is_null($quizObj)) { return false; }
        
        if (strtotime(Date("Y-m-d H:i:s")) < strtotime($quizObj->getStartDateTime())) {
            $this->addError("Quiz not opened yet");
        }
        
        if (strtotime(Date("Y-m-d H:i:s")) > strtotime($quizObj->getEndDateTime())) {
            $this->addError("Quiz has been closed");
        }
        
        $StudentQuizService = new StudentQuizService();
        $StudentQuizFilter = new StudentQuizFilter();
        $StudentQuizFilter->setQuizId($quizObj->getId());
        if (!is_null($this->mUserInfo)) {
            $StudentQuizFilter->setUserName($this->mUserInfo->getUserName());
        }
        $StudentQuizs = $StudentQuizService->getList($StudentQuizFilter);
        if (!is_null($StudentQuizs) && count($StudentQuizs) > 0) {
            $this->addError("Quiz have been done");
        }
        return $this->getModelState();
    }
    
    private function bindData($param) {
        $QuizObj = new Quiz();
        if (!is_null($param) && count($param) > 0) {
			$QuizObj->setId($param["id"]);
			$QuizObj->setQuizName($param["quiz_name"]);
            $CourseObj = new Course();
            $CourseObj->setCode($param["course_code"]);
            $CourseObj->setIsLoaded(true);
			$QuizObj->setCourse($CourseObj);
            $QuizTypeObj = new QuizType();
            $QuizTypeObj->setId($param["quiz_type_id"]);
            $QuizTypeObj->setIsLoaded(true);
			$QuizObj->setQuizType($QuizTypeObj);
			$QuizObj->setStartDateTime($param["start_date_time"]);
			$QuizObj->setEndDateTime($param["end_date_time"]);
            $QuizObj->setQuizTime($param["quiz_time"]);
        }
        return $QuizObj;
    }
    
    private function bindDataStudentQuiz($param, $id) {
        $StudentQuizObj = new StudentQuiz();
        $Quiz = $this->QuizService->getQuiz($id);
        if (!is_null($param) && count($param) > 0) {
            $StudentQuizObj->setQuiz($Quiz);
            $StudentAnswers = $this->bindDataStudentQuizAnswer($param);
            $StudentQuizObj->setStudentAnswers($StudentAnswers);
        }
        
        return $StudentQuizObj;
    }
    
    private function bindDataStudentQuizAnswer($param) {
        $StudentAnswers = array();
        $arr_QuestionDetails = $param["question_details"];
        $arr_QuestionId = $param["question_id"];
        
        if (count($arr_QuestionDetails) > 0) {
            for($i = 0;$i < count($arr_QuestionDetails);$i++) {
                $StudentAnswerObj = new StudentAnswer();
                $QuizQuestionService = new QuizQuestionService();
                $quiz_question_id = $arr_QuestionId[$i];
                $QuizQuestion = $QuizQuestionService->getQuizQuestion($quiz_question_id);
                $StudentAnswerObj->setQuizQuestion($QuizQuestion);
                $AnswerObj = new Answer();
                if (isset($param["Question".$i])) {
                    $param_answer = $param["Question".$i];
                    if (count($param_answer)) {
                        $AnswerObj->setId($param_answer[0]);
                        $AnswerObj->setIsLoaded(true);
                    }
                }
                $StudentAnswerObj->setAnswer($AnswerObj);
                $StudentAnswerObj->setIsLoaded(true);
                $StudentAnswers[] = $StudentAnswerObj;
            }
        }
        
        return $StudentAnswers;
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
    
    private function loadCourseList()
	{
		$CourseService = new CourseService();
		$CourseFilter = new CourseFilter();
        if ($this->mUserGroup == "instructor") {
            $CourseCode = (!is_null($this->mUserInfo) ? ((!is_null($this->mUserInfo->getInstructor())) ? ((!is_null($this->mUserInfo->getInstructor()->getCourse())) ? $this->mUserInfo->getInstructor()->getCourse()->getCode() : "" ) : "") : "");
            $CourseFilter->setCourseCode($CourseCode);
        }
        $CourseList = $CourseService->getList($CourseFilter);
		$this->data['CourseList'] = $CourseList;
	}
    
    private function loadQuizTypeList()
	{
		$QuizTypeService = new QuizTypeService();
		$QuizTypeList = $QuizTypeService->getList(); 
		$this->data['QuizTypeList'] = $QuizTypeList;
	}
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Quiz - ";
    }
    
    private function loadDefaultService() {
        $this->QuizService = new QuizService();
    }
}
