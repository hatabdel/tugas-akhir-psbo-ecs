<?php

class AnswerTypeService extends BaseService {
    
    private $AnswerTypeDao;
    
    public function __construct() {
        parent::__construct();
        $this->AnswerTypeDao = new AnswerTypeDao();
    }
    
    public function getList() {
        try {
            return $this->AnswerTypeDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getAnswerType($id) {
        try { 
            return $this->AnswerTypeDao->getAnswerType($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertAnswerType($AnswerTypeObj) {
        try {
            if (!$this->validateOnInsert($AnswerTypeObj)) { return false; }
			return $this->AnswerTypeDao->InsertAnswerType($AnswerTypeObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateAnswerType($AnswerTypeObj, $Id) {
        try {
            if (!$this->validateOnUpdate($AnswerTypeObj)) { return false; }
            return $this->AnswerTypeDao->UpdateAnswerType($AnswerTypeObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteAnswerType($Id) {
        try {
            return $this->AnswerTypeDao->DeleteAnswerType($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
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

