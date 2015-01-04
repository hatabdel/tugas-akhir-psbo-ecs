<?php

class QuizService extends BaseService {
    
    private $QuizDao;
    
    public function __construct() {
        parent::__construct();
        $this->QuizDao = new QuizDao();
    }
    
    public function getList() {
        try {
            return $this->QuizDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getQuiz($id) {
        try { 
            return $this->QuizDao->getQuiz($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertQuiz($QuizObj) {//var_dump($QuizObj); die();
        try {
            if (!$this->validateOnInsert($QuizObj)) { return false; }//var_dump($QuizObj);	die();
            return $this->QuizDao->InsertQuiz($QuizObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateQuiz($QuizObj, $Id) {
        try {
            if (!$this->validateOnUpdate($QuizObj)) { return false; }
            return $this->QuizDao->UpdateQuiz($QuizObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteQuiz($Id) {
        try {
            return $this->QuizDao->DeleteQuiz($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getQuizName()) || empty($model->getQuizName())) {
            $this->addError("Quiz Name is required!");
        }
                
        if (is_null($model->getCourseCode()) || empty($model->getCourseCode())) {
            $this->addError("Course Code is required!");
        }
        
        
        if (is_null($model->getQuizTypeId()) || empty($model->getQuizTypeId())) {
            $this->addError("Quiz Type Id is required!");
        }
		
        if (is_null($model->getStartDateTime()) || empty($model->getStartDateTime())) {
            $this->addError("Start Date Time is required!");
        }
        
        if (is_null($model->getEndDateTime()) || empty($model->getEndDateTime())) {
            $this->addError("End Date Time is required!");
        }
          
        if (is_null($model->getCreatedDate()) || empty($model->getCreatedDate())) {
            $this->addError("Created Date is required!");
        }
          
        if (is_null($model->getCreatedUser()) || empty($model->getCreatedUser())) {
            $this->addError("Created User is required!");
        }
        
        if (is_null($model->getUpdateDate()) || empty($model->getUpdateDate())) {
            $this->addError("Update Date is required!");
        }
          
        if (is_null($model->getUpdateUser()) || empty($model->getUpdateUser())) {
            $this->addError("Update User is required!");
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        
        if (!is_null($model->getQuizId()) && !empty($model->getQuizId())) {
            $QuizObj = $this->getQuiz($model->getQuizId());
            if (!is_null($QuizObj)) {
                $this->addError("Data with code ".$model->getQuizId()." is already exist!");
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

