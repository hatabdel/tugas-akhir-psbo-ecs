<?php

class BaseController extends Controller {

    protected $login_url;
    protected $access_denied_url;
    protected $data;
    protected $errors = array();
    protected $mUserInfo = null;
    protected $function_id;
    protected $active_privilege = null;

    public function __construct() {
        $this->setupLayout();
        $this->login_url = url();
        $this->access_denied_url = url();
        $this->data["errors"] = "";
        $this->mUserInfo = null;
        $this->data["function_id"] = $this->function_id;
    }
    
    /*
	 * Setup the layout used by the controller.
	 * @return void
	 */
    protected function setupLayout()
	{
        if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}
    
    
    protected function logon($user_name, $password) {
        $UserInfoService = new UserInfoService();
        $result = $UserInfoService->CheckUserLogin($user_name, $password);
        
        if (!is_null($result)) {
            Session::put("UserInfo", serialize($result));
            return true;
        } else {
            return false;
        }
    }
    
    protected function IsLogin() {
        if (Session::has("UserInfo")) {
            $this->mUserInfo = Session::get("UserInfo");
            $this->mUserInfo = unserialize($this->mUserInfo);
        }
        if (!is_null($this->mUserInfo)) {
            $this->data["UserInfo"] = $this->mUserInfo;
            return true;
        }
        return false;
    }
    
    protected function IsAllowRead() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            return boolval($this->active_privilege->IsAllowRead());
        } else {
            return false;
        }
    }
    
    protected function IsAllowCreate() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            return boolval($this->active_privilege->IsAllowCreate());
        } else {
            return false;
        }
    }
    
    protected function IsAllowUpdate() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            return boolval($this->active_privilege->IsAllowUpdate());
        } else {
            return false;
        }
    }
    
    protected function IsAllowDelete() {
        if (is_null($this->active_privilege)) {
            $this->loadPrivileges();
        }
        if (!is_null($this->active_privilege)) {
            return boolval($this->active_privilege->IsAllowDelete());
        } else {
            return false;
        }
    }
    
    protected function loadPrivileges() {
        $UserGroupId = (!is_null($this->mUserInfo) ? (!is_null($this->mUserInfo->getUserGroup()) ?  $this->mUserInfo->getUserGroup()->getId() : "") : "");
        $FunctionId = $this->function_id;
        $PrivilegeInfoFilter = new PrivilegeInfoFilter();
        $PrivilegeInfoFilter->setUserGroupId($UserGroupId);
        $PrivilegeInfoFilter->setFunctionId($FunctionId);
        
        $PrivilegeInfoService = new PrivilegeInfoService();
        $PrivilegeInfoList =  $PrivilegeInfoService->getList($PrivilegeInfoFilter);
        
        if (!is_null($PrivilegeInfoList)) {
            if (count($PrivilegeInfoList) > 0) {
                $this->active_privilege = $PrivilegeInfoList[0];
            }
        }
        
    }

    protected function addError($err) {
        if (is_null($err) || empty($err)) { return; }
        $this->errors[] = '<li>'.$err.'</li>';
        $this->getErrors();
    }
    
    protected function addErrorValidation($errors) {
        if (is_null($errors)) { return; }
        foreach ($errors->all('<li>:message</li>') as $message)
        {
            $this->errors[] = $message;
        }
        
        $this->getErrors();
    }
    
    protected function addErrors($arr_err) {
        if (is_null($arr_err) || empty($arr_err)) { return; }
        foreach ($arr_err as $err) {
           $this->errors[] = '<li>'.$err.'</li>';
        }
        $this->getErrors();
    }
    
    protected function getErrors() {
        if (!is_null($this->errors) && count($this->errors) > 0) {
            $this->data["errors"] = "<div class=\"alert alert-danger\" role=\"alert\">";
            foreach($this->errors as $error) {
                $this->data["errors"] .= $error;
            }
            $this->data["errors"] .= "</div>";
        }
    }
    
}
