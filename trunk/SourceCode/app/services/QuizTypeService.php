<?php

class QuizTypeService extends BaseService {
    
    private $QuizTypeDao;
    
    public function __construct() {
        parent::__construct();
        $this->QuizTypeDao = new QuizTypeDao();
    }
    
    public function getList() {
        try {
            return $this->QuizTypeDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getQuizType($id) {
        try { 
            return $this->QuizTypeDao->getQuizType($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertQuizType($QuizTypeObj) {
        try {
            if (!$this->validateOnInsert($QuizTypeObj)) { return false; }
			
		//var_dump($QuizTypeObj);	die();
            return $this->QuizTypeDao->InsertQuizType($QuizTypeObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateQuizType($QuizTypeObj, $Id) {
        try {
            if (!$this->validateOnUpdate($QuizTypeObj)) { return false; }
            return $this->QuizTypeDao->UpdateQuizType($QuizTypeObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteQuizType($Id) {
        try {
            return $this->QuizTypeDao->DeleteQuizType($Id);
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
		
		if (!is_null($model->getQuizType()) && !empty($model->getQuizType())) {
            $QuizTypeObj = $this->getQuizType($model->getQuizType());
            if (!is_null($QuizTypeObj)) {
                $this->addError("Data with code ".$model->getQuizType()." is already exist!");
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

