<?php

class UserInfoService extends BaseService {
    
    private $UserInfoDao;
    
    public function __construct() {
        parent::__construct();
        $this->UserInfoDao = new UserInfoDao();
    }
    
    public function getList($filter) {
        try {
            return $this->UserInfoDao->getList($filter);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getUserInfo($id) {
        try {
            return $this->UserInfoDao->getUserInfo($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertUserInfo($UserInfoObj) {
        try {
            if (!$this->validateOnInsert($UserInfoObj)) { return false; }
            $UserInfoObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $result = $this->UserInfoDao->InsertUserInfo($UserInfoObj);
            
            if (!is_null($this->UserInfoDao->getError()) && !empty($this->UserInfoDao->getError())) {
                $this->addError($this->UserInfoDao->getError());
            }
            
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateUserInfo($UserInfoObj, $id) {
        try {
            if (!$this->validateOnUpdate($UserInfoObj)) { return false; }
            $UserInfoObjOld = $this->getUserInfo($id);
            if (!is_null($UserInfoObjOld)) {
                $UserInfoObj->setCreatedDate($UserInfoObjOld->getCreatedDate());
            }
            $UserInfoObj->setUpdatedDate(Date("Y-m-d H:i:s"));
            
            $result = $this->UserInfoDao->UpdateUserInfo($UserInfoObj, $id);
            if (!is_null($this->UserInfoDao->getError()) && !empty($this->UserInfoDao->getError())) {
                $this->addError($this->UserInfoDao->getError());
            }
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteUserInfo($Id) {
        try {
            return $this->UserInfoDao->DeleteUserInfo($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function CheckUserLogin($username, $password) {
        $UserInfoFilter = new UserInfoFilter();
        $UserInfoFilter->setUserName($username);
        $UserInfoFilter->setPassword(md5($password));
        
        $UserInfoList = $this->getList($UserInfoFilter);
        if (!is_null($UserInfoList)) {
            if (count($UserInfoList) > 0) {
                return $UserInfoList[0];
            }
        }
        
        return null;       
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getUserName()) || empty($model->getUserName())) {
            $this->addError("Code is required!");
        }
        
        if (is_null($model->getPassword()) || empty($model->getPassword())) {
            $this->addError("Name is required!");
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        
        if (!is_null($model->getUserName()) && !empty($model->getUserName())) {
            $UserInfoObj = $this->getUserInfo($model->getUserName());
            if (!is_null($UserInfoObj)) {
                $this->addError("Data with code ".$model->getUserName()." is already exist!");
            }
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnUpdate($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        return $this->getServiceState();
    }
}

