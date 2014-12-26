<?php

class UserGroupService extends BaseService {
    
    private $UserGroupDao;
    
    public function __construct() {
        parent::__construct();
        $this->UserGroupDao = new UserGroupDao();
    }
    
    public function getList() {
        try {
            return $this->UserGroupDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getUserGroup($id) {
        try { 
            return $this->UserGroupDao->getUserGroup($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertUserGroup($UserGroupObj) {
        try {
            if (!$this->validateOnInsert($UserGroupObj)) { return false; }
            return $this->UserGroupDao->InsertUserGroup($UserGroupObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateUserGroup($UserGroupObj, $Id) {
        try {
            if (!$this->validateOnUpdate($UserGroupObj)) { return false; }
            return $this->UserGroupDao->UpdateUserGroup($UserGroupObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteUserGroup($Id) {
        try {
            return $this->UserGroupDao->DeleteUserGroup($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getName()) || empty($model->getName())) {
            $this->addError("Name is required!");
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        return $this->getServiceState();
    }
    
    private function validateOnUpdate($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        return $this->getServiceState();
    }
}

