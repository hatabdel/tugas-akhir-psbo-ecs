<?php

class UserInfoController extends BaseController {
    
    private $UserInfoService;
    protected $function_id = "user_info";
    
    public function __construct() {
        parent::__construct();
        $this->loadDefaultValue();
        $this->loadDefaultService();
    }
    
    public function index() {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $UserInfoList = $this->UserInfoService->getList(null);
        $this->data['UserInfoList'] = $UserInfoList;
        return View::make("userinfo/index", $this->data);
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
                    $this->UserInfoService->setUserInfo($this->mUserInfo);
                    $result = $this->UserInfoService->InsertUserInfo($model);
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages());
                    }
                    return Redirect::to("userinfo/detail/".$model->getUserName());
                }
            }
            return $this->createInputView($model);
        } catch (Exception $ex) {
            return $this->createInputView(null);
        }
    }
    
    public function edit($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowUpdate()) { return Redirect::to("access_denied"); }
        
        $model = $this->UserInfoService->getUserInfo($id);
        try {
            $input = Input::all();
            if (count($input) > 0) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "edit");
                } else {
                    $result = $this->UserInfoService->UpdateUserInfo($model, $model->getUserName());
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "edit");
                    }
                    return Redirect::to("userinfo/detail/".$model->getUserName());
                }
            }
            return $this->createInputView($model, null, "edit");
        } catch (Exception $ex) {
            return $this->createInputView(null, null, "edit");
        }
    }
    
    public function register() {
        try {
            $input = Input::all();
            $user_type = (isset($input["user_type"]) ? $input["user_type"] : null);
            if (is_null($user_type) || empty($user_type)) {
                return Redirect::to("login");
            }
            $model = null;
            $this->data["user_type"] = $user_type;
            if (count($input) > 0 && isset($input["user_name"])) {
                $model = $this->bindData($input);
                $validation = Validator::make($input, $this->initValidation());
                if ($validation->fails()) {
                    return $this->createInputView($model, $validation->messages(), "register");
                } else {
                    $this->UserInfoService->setUserInfo($this->mUserInfo);
                    $result = $this->UserInfoService->InsertUserInfo($model);
                    
                    if (!$result) {
                        $this->addErrors($this->UserInfoService->getErrors());
                        return $this->createInputView($model, $validation->messages(), "register");
                    }
                    
                    if ($user_type == "instructor") {
                        $InstructorObj = $this->bindDataInstructor($input);
                        $InstructorService = new InstructorService();
                        $InstructorService->setUserInfo($this->mUserInfo);
                        $result = $InstructorService->InsertInstructor($InstructorObj);
                    }
                    
                    return Redirect::to("userinfo/detail/".$model->getUserName());
                }
            }
            return $this->createInputView($model, null, "register");
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            return $this->createInputView(null, null, "register");
        }
    }
    
    public function delete($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowDelete()) { return Redirect::to("access_denied"); }
        try {
            $model = $this->UserInfoService->getUserInfo($id);
            if (is_null($model)) { return Redirect::to("userinfo"); }
            $this->UserInfoService->DeleteUserInfo($id);
            return Redirect::to("userinfo");
        } catch (Exception $ex) {
            var_dump($ex->messages()); die();
        }
    }
    
    public function detail($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowUpdate()) { return Redirect::to("access_denied"); }
        
        $this->data["model"] = $this->UserInfoService->getUserInfo($id);
        return View::make("userinfo/detail", $this->data);
    }
    
    public function active($id) {
        if (!$this->IsLogin()) { return Redirect::to("login"); }
        if (!$this->IsAllowRead()) { return Redirect::to("access_denied"); }
        
        $model = $this->UserInfoService->getUserInfo($id);
        if (is_null($model)) { return Redirect::to("/"); }
        $this->UserInfoService->ActivateUserInfo($id);
        return Redirect::to("userinfo");
    }
    
    private function createInputView($model, $validation = null, $mode = "create") {
        if (!is_null($model)) {
            $this->data["model"] = $model;
        } else {
            $this->data["model"] = new UserInfo();
        }
        if ($mode == "create") {
            $this->data["action"] = "/userinfo/".$mode;
        } else if ($mode == "register") {
            $this->data["action"] = "/".$mode;
        } else {
            $this->data["action"] = "/userinfo/".$mode."/".(!is_null($model) ? $model->getUserName() : "");
        }
        
        $this->data["user_group"] = (is_null($this->mUserInfo) ? "" : (!is_null($this->mUserInfo->getUserGroup()) ? $this->mUserInfo->getUserGroup()->getName() : ""));
        $this->data["mode"] = $mode;
        $this->loadUserGroupList();
        $this->loadCourseList();
        $this->addErrorValidation($validation);
        return View::make("userinfo/input", $this->data);
    }
    
    private function initValidation() {
        $form_validation = array(
            "user_name" => "required",
            "password" => "required",
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email"
        );
        return $form_validation;
    }
    
    private function bindData($param) {
        $UserInfoObj = new UserInfo();
        if (!is_null($param) && count($param) > 0) {
            $UserInfoObj->setUserName((isset($param["user_name"]) ? $param["user_name"] : ""));
            $UserInfoObj->setPassword((isset($param["password"]) ? $param["password"] : ""));
            $UserInfoObj->setFirstName((isset($param["first_name"]) ? $param["first_name"] : ""));
            $UserInfoObj->setLastName((isset($param["last_name"]) ? $param["last_name"] : ""));
            $UserInfoObj->setEmail((isset($param["email"]) ? $param["email"] : ""));
            if (isset($param["is_active"])) {
                $UserInfoObj->setIsActive($param["is_active"]);
            }
            if (isset($param["user_group_id"])) {
                $UserGroupObj = new UserGroup();
                $UserGroupObj->setId($param["user_group_id"]);
                $UserGroupObj->setIsLoaded(true);
                $UserInfoObj->setUserGroup($UserGroupObj);
            }
            if (isset($param["user_type"])) {
                if ($param["user_type"] == "student") {
                    $UserGroupObj = new UserGroup();
                    $UserGroupObj->setId("5");
                    $UserGroupObj->setIsLoaded(true);
                    $UserInfoObj->setUserGroup($UserGroupObj);
                    $UserInfoObj->setIsActive(true);
                } else if ($param["user_type"] == "instructor") {
                    $UserGroupObj = new UserGroup();
                    $UserGroupObj->setId("4");
                    $UserGroupObj->setIsLoaded(true);
                    $UserInfoObj->setUserGroup($UserGroupObj);
                    $UserInfoObj->setIsActive(false);
                }
            }
        }
        
        return $UserInfoObj;
    }
    
    private function bindDataInstructor($param) {
        $instructorObj = new Instructor();
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($param["user_name"]);
        $UserInfoObj->setIsLoaded(true);
        $instructorObj->setUserInfo($UserInfoObj);
        $Course = new Course();
        $Course->setCode($param['course_code']);
        $Course->setIsLoaded(true);
        $instructorObj->setCourse($Course);
        
        return $instructorObj;
    }
    
    private function loadDefaultValue() {
        $this->data["_MODULE_NAME"] = "User Info - ";
    }
    
    private function loadUserGroupList() {
        $UserGroupService = new UserGroupService();
        $UserGroupList = $UserGroupService->getList();
        $this->data['UserGroupList'] = $UserGroupList;
    }
    
    private function loadCourseList()
	{
		$CourseService = new CourseService();
		$CourseList = $CourseService->getList(); 
		$this->data['CourseList'] = $CourseList;
	}
    
    private function loadDefaultService() {
        $this->UserInfoService = new UserInfoService();
    }
}
