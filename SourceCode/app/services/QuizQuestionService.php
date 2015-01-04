<?php

class QuizQuestionService extends BaseService {
    
    private $QuizQuestionDao;
    
    public function __construct() {
        parent::__construct();
        $this->QuizQuestionDao = new QuizQuestionDao();
    }
    
    public function getList() {
        try {
            return $this->QuizQuestionDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getQuizQuestion($id) {
        try { 
            return $this->QuizQuestionDao->getQuizQuestion($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertQuizQuestion($QuizQuestionObj) {
        try {
            if (!$this->validateOnInsert($QuizQuestionObj)) { return false; }//var_dump($QuizQuestionObj);	die();
            return $this->QuizQuestionDao->InsertQuizQuestion($QuizQuestionObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateQuizQuestion($QuizQuestionObj, $Id) {
        try {
            if (!$this->validateOnUpdate($QuizQuestionObj)) { return false; }
            return $this->QuizQuestionDao->UpdateQuizQuestion($QuizQuestionObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteQuizQuestion($Id) {
        try {
            return $this->QuizQuestionDao->DeleteQuizQuestion($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        /*
        if (is_null($model->getQuizQuestionId()) || empty($model->getQuizQuestionId())) {
            $this->addError("Quiz Question Id is required!");
        }*/
        
        if (is_null($model->getQuizId()) || empty($model->getQuizId())) {
            $this->addError("Quiz Id is required!");
        }
        
        
        if (is_null($model->getQuestion()) || empty($model->getQuestion())) {
            $this->addError("Question is required!");
        }
        
        
        if (is_null($model->getAnswerTypeId()) || empty($model->getAnswerTypeId())) {
            $this->addError("Answer Type Id is required!");
        }
        
        
        if (is_null($model->getScore()) || empty($model->getScore())) {
            $this->addError("Score Id is required!");
        }
		
		
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        
		if (!is_null($model->getQuizQuestionId()) && !empty($model->getQuizQuestionId())) {
            $CourseObj = $this->getQuizQuestion($model->getQuizQuestionId());
            if (!is_null($CourseObj)) {
                $this->addError("Data with code ".$model->getQuizQuestionId()." is already exist!");
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

