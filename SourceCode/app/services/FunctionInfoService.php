<?php

class FunctionInfoService extends BaseService {
    
    private $FunctionInfoDao;
    
    public function __construct() {
        parent::__construct();
        $this->FunctionInfoDao = new FunctionInfoDao();
    }
    
    public function getList() {
        try {
            return $this->FunctionInfoDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getFunctionInfo($id) {
        try { 
            return $this->FunctionInfoDao->getFunctionInfo($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertFunctionInfo($FunctionInfoObj) {
        try {
            if (!$this->validateOnInsert($FunctionInfoObj)) { return false; }
            return $this->FunctionInfoDao->InsertFunctionInfo($FunctionInfoObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateFunctionInfo($FunctionInfoObj, $Id) {
        try {
            if (!$this->validateOnUpdate($FunctionInfoObj)) { return false; }
            return $this->FunctionInfoDao->UpdateFunctionInfo($FunctionInfoObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteFunctionInfo($Id) {
        try {
            return $this->FunctionInfoDao->DeleteFunctionInfo($Id);
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
            $this->addError("Function Id is required!");
        }
        
        if (is_null($model->getUrl()) || empty($model->getUrl())) {
            $this->addError("URL is required!");
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

