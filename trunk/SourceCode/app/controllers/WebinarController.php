<?php

class WebinarController extends BaseController {
    
    private $WebinarService;
    protected $function_id = "webinar";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $WebinarList = $this->WebinarService->getList();
        $this->data['WebinarList'] = $WebinarList;
        return View::make("webinar/index", $this->data);
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
                    $this->WebinarService->setUserInfo($this->mUserInfo);
                    $result = $this->WebinarService->InsertWebinar($model);
                    if (!$result) {
                        $this->addErrors($this->WebinarService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("webinar/detail/".$model->getId());
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
        
        $model = $this->WebinarService->getWebinar($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->WebinarService->UpdateWebinar($model, $model->getId());
                    if (!$result) {
                        $this->addErrors($this->WebinarService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("webinar/detail/".$model->getId());
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
            $model = $this->WebinarService->getWebinar($id);
            if (is_null($model)) { return Redirect::to("webinar"); }
            $this->WebinarService->DeleteWebinar($id);
            return Redirect::to("webinar");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("webinar");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->WebinarService->getWebinar($id);
        return View::make("webinar/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Webinar();
        }
        if ($mode == "create") {
            $this->data["action"] = "/webinar/".$mode;
        } else {
            $this->data["action"] = "/webinar/".$mode."/".(!is_null($model) ? $model->getId() : "");
        }
        $this->data["mode"] = $mode;
        $this->loadCourseList();
        
        $this->addErrorValidation($validation);
        return View::make("webinar/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "title" => "required",
            "start_date" => "required",
            "end_date" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        try {
        $WebinarObj = new Webinar();
        
        if (!is_null($param) && count($param) > 0) {
            $WebinarObj = new Webinar();
            $WebinarObj->setId($param["id"]);
            $WebinarObj->setTitle($param["title"]);
            $CourseObj = new Course();
            $CourseObj->setCode($param["course_code"]);
            $CourseObj->setIsLoaded(false);
            $WebinarObj->setCourse($CourseObj);
            $WebinarObj->setStartDate($param["start_date"]);
            $WebinarObj->setEndDate($param["end_date"]);
            $WebinarObj->setIsLoaded(true);
        }
        
        return $WebinarObj;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
        }
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "Webinar - ";
    }
    
    private function loadCourseList() {
        $CourseService = new CourseService();
        $CourseList = $CourseService->getList();
        $this->data['CourseList'] = $CourseList;
    }
    
    private function loadDefaultService() {
        $this->WebinarService = new WebinarService();
    }
}
