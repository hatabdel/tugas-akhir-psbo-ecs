<?php

class PrivilegeInfoService extends BaseService {
    
    private $PrivilegeInfoDao;
    
    public function __construct() {
        parent::__construct();
        $this->PrivilegeInfoDao = new PrivilegeInfoDao();
    }
    
    public function getList() {
        try {
            return $this->PrivilegeInfoDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getPrivilegeInfo($id) {
        try { 
            return $this->PrivilegeInfoDao->getPrivilegeInfo($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertPrivilegeInfo($PrivilegeInfoObj) {
        try {
            if (!$this->validateOnInsert($PrivilegeInfoObj)) { return false; }
            return $this->PrivilegeInfoDao->InsertPrivilegeInfo($PrivilegeInfoObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdatePrivilegeInfo($PrivilegeInfoObj, $Id) {
        try {
            if (!$this->validateOnUpdate($PrivilegeInfoObj)) { return false; }
            return $this->PrivilegeInfoDao->UpdatePrivilegeInfo($PrivilegeInfoObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeletePrivilegeInfo($Id) {
        try {
            return $this->PrivilegeInfoDao->DeletePrivilegeInfo($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getFunctionId()) || empty($model->getFunctionId())) {
            $this->addError("Function is required!");
        }
        
        if (is_null($model->getUserGroupId()) || empty($model->getUserGroupId())) {
            $this->addError("User Group is required!");
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

