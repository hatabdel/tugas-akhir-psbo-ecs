<?php

class UserInfoService extends BaseService {
    
    private $UserInfoDao;
    
    public function __construct() {
        parent::__construct();
        $this->UserInfoDao = new UserInfoDao();
    }
    
    public function getList() {
        try {
            return $this->UserInfoDao->getList();
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
            return $this->UserInfoDao->InsertUserInfo($UserInfoObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateUserInfo($UserInfoObj, $Id) {
        try {
            if (!$this->validateOnUpdate($UserInfoObj)) { return false; }
            return $this->UserInfoDao->UpdateUserInfo($UserInfoObj, $Id);
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
    
    private function createCriteria($filter) {
        
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

