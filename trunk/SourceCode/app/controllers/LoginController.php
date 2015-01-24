<?php

class LoginController extends BaseController {
    
    protected $function_id = "login";
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $input = Input::all();
        
        if (count($input) > 0) {
            $validation = Validator::make($input, $this->initValidation());
            if ($validation->fails()) {
                $this->addErrorValidation($validation->messages());
                return View::make("login/index", $this->data);
            } else {
                $user_name = $input["username"];
                $password = $input["password"];
                $result = $this->logon($user_name, $password);
                if (!$result) {
                    $this->addError("Username or Password Incorect or Your account are not yet approved");
                    return View::make("login/index", $this->data);
                }
                return Redirect::to("/");
            }
        }
        
        return View::make("login/index", $this->data);
    }
    
    public function logout() {
        if (Session::has("UserInfo"))
        {
            Session::forget("UserInfo");
        }
        if (Session::has('quiz_start_time')) {
            Session::forget('quiz_start_time');
        }
        $this->mUserInfo = null;
        return Redirect::to("login");
    }
    
    private function initValidation() {
        $form_validation = array(
            "username" => "required",
            "password" => "required"
        );
        return $form_validation;
    }
    
}