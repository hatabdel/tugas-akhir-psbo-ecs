<?php

class StudentAnswerService extends BaseService {
    
    private $StudentAnswerDao;
    
    public function __construct() {
        parent::__construct();
        $this->StudentAnswerDao = new StudentAnswerDao();
    }
    
    public function getList() {
        try {
            return $this->StudentAnswerDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getStudentAnswer($id) {
        try { 
            return $this->StudentAnswerDao->getStudentAnswer($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertStudentAnswer($StudentAnswerObj) {
        try {
            if (!$this->validateOnInsert($StudentAnswerObj)) { return false; }//var_dump($StudentAnswerObj);	die();
            return $this->StudentAnswerDao->InsertStudentAnswer($StudentAnswerObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateStudentAnswer($StudentAnswerObj, $Id) {
        try {
            if (!$this->validateOnUpdate($StudentAnswerObj)) { return false; }
            return $this->StudentAnswerDao->UpdateStudentAnswer($StudentAnswerObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteStudentAnswer($Id) {
        try {
            return $this->StudentAnswerDao->DeleteStudentAnswer($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
      /*  if (is_null($model->getStudentAnswerId()) || empty($model->getStudentAnswerId())) {
            $this->addError("Student Answer Id is required!");
        }*/
        
        if (is_null($model->getStudentQuizId()) || empty($model->getStudentQuizId())) {
            $this->addError("Student Quiz Id is required!");
        }
        
        if (is_null($model->getQuizQuestionId()) || empty($model->getQuizQuestionId())) {
            $this->addError("Quiz Question Id is required!");
        }
        
        
        if (is_null($model->getStudentAnswer()) || empty($model->getStudentAnswer())) {
            $this->addError("Student Answer Id is required!");
        }
        
        
        if (is_null($model->getScore()) || empty($model->getScore())) {
            $this->addError("Score Id is required!");
        }
		
		
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		
        if (!is_null($model->getStudentAnswerId()) && !empty($model->getStudentAnswerId())) {
            $StudentAnswerObj = $this->getStudentAnswer($model->getStudentAnswerId());
            if (!is_null($StudentAnswerObj)) {
                $this->addError("Data with code ".$model->getStudentAnswerId()." is already exist!");
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

