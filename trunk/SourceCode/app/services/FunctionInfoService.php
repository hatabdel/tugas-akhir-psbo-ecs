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
            
        }
    }
    
    public function getFunctionInfo($id) {
        try { 
            return $this->FunctionInfoDao->getFunctionInfo($id);
        } catch (Exception $ex) {
            
        }
    }
    
    public function InsertFunctionInfo($FunctionInfoObj) {
        try {
            return $this->FunctionInfoDao->InsertFunctionInfo($FunctionInfoObj);
        } catch (Exception $ex) {
            
        }
    }
    
    public function UpdateFunctionInfo($FunctionInfoObj, $Id) {
        try {
            return $this->FunctionInfoDao->UpdateFunctionInfo($FunctionInfoObj, $Id);
        } catch (Exception $ex) {
            
        }
    }
    
    public function DeleteFunctionInfo($Id) {
        try {
            return $this->FunctionInfoDao->DeleteFunctionInfo($Id);
        } catch (Exception $ex) {
            
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validate($model) {
        
    }
    
    private function validateOnInsert($model) {
        
    }
    
    private function validateOnDelete($model) {
        
    }
}

