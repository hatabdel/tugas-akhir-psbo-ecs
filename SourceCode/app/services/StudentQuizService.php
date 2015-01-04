<?php

class StudentQuizService extends BaseService {
    
    private $StudentQuizDao;
    
    public function __construct() {
        parent::__construct();
        $this->StudentQuizDao = new StudentQuizDao();
    }
    
   public function getList() {
        try {
            return $this->StudentQuizDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
   public function getStudentQuiz($id) {
        try { 
            return $this->StudentQuizDao->getStudentQuiz($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
       public function InsertStudentQuiz($StudentQuizObj) {
        try {
            if (!$this->validateOnInsert($StudentQuizObj)) { return false; }//var_dump($StudentQuizObj);	die();
            return $this->StudentQuizDao->InsertStudentQuiz($StudentQuizObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateStudentQuiz($StudentQuizObj, $Id) {
        try {
            if (!$this->validateOnUpdate($StudentQuizObj)) { return false; }
            return $this->StudentAnswerDao->UpdateStudentQuiz($StudentQuizObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
      
    public function DeleteStudentQuiz($Id) {
        try {
            return $this->StudentQuizDao->DeleteStudentQuiz($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
        private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getIdentityId()) || empty($model->getIdentityId())) {
            $this->addError("Identity Id is required!");
        }
        
        if (is_null($model->getQuizId()) || empty($model->getQuizId())) {
            $this->addError("Quiz Id is required!");
        }
        
        
        if (is_null($model->getTotalScore()) || empty($model->getTotalScore())) {
            $this->addError("Total Score is required!");
        }
        
        if (is_null($model->getStartDateTime()) || empty($model->getStartDateTime())) {
            $this->addError("Start Date Time is required!");
        }
		
        if (is_null($model->getEndDateTime()) || empty($model->getEndDateTime())) {
            $this->addError("End Date Time is required!");
        }
		
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		
		if (!is_null($model->getStudentQuizId()) && !empty($model->getStudentQuizId())) {
            $StudentQuizObj = $this->getStudentQuiz($model->getStudentQuizId());
            if (!is_null($StudentQuizObj)) {
                $this->addError("Data with code ".$model->getStudentQuizId()." is already exist!");
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


