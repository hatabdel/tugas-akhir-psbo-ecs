<?php

class CourseController extends BaseController {
    
    private $CourseService;
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        $CourseList = $this->CourseService->getList();
        $this->data['CourseList'] = $CourseList;
        return View::make("course/index", $this->data);
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
                    $this->CourseService->setUserInfo($this->mUserInfo);
                    $result = $this->CourseService->InsertCourse($model);
                    if (!$result) {
                        $this->addErrors($this->CourseService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("course/detail/".$model->getCode());
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
        
        $model = $this->CourseService->getCourse($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $this->CourseService->setUserInfo($this->mUserInfo);
                    $result = $this->CourseService->UpdateCourse($model, $model->getCode());
                    if (!$result) {
                        $this->addErrors($this->CourseService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("course/detail/".$model->getCode());
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
            $model = $this->CourseService->getCourse($id);
            if (is_null($model)) { return Redirect::to("course"); }
            $this->CourseService->DeleteCourse($id);
            return Redirect::to("course");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return Redirect::to("course");
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->CourseService->getCourse($id);
        return View::make("course/detail", $this->data);
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new Course();
        }
        if ($mode == "create") {
            $this->data["action"] = "/course/".$mode;
        } else {
            $this->data["action"] = "/course/".$mode."/".(!is_null($model) ? $model->getCode() : "");
        }
        
        $this->loadFunctionList();
        $this->loadUsertGroupList();
        
        $this->addErrorValidation($validation);
        return View::make("course/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "code" => "required",
            "name" => "required",
            "description" => "required",
            "start_date" => "required",
            "end_date" => "required"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $CourseObj = new Course();
        if (!is_null($param) && count($param) > 0) {
            $CourseObj->setCode($param["code"]);
            $CourseObj->setName($param["name"]);
            $CourseObj->setDescription($param["description"]);
            $CourseObj->setStartDate($param["start_date"]);
            $CourseObj->setEndDate($param["end_date"]);
            $CourseObj->setIsActive($param["is_active"]);
        }
        return $CourseObj;
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
        $this->data["_MODULE_NAME"] = "Course - ";
    }
    
    private function loadDefaultService() {
        $this->CourseService = new CourseService();
    }
}
