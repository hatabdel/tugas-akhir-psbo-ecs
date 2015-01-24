<?php

class QuizService extends BaseService {
    
    private $QuizDao;
    
    public function __construct() {
        parent::__construct();
        $this->QuizDao = new QuizDao();
    }
    
    public function getList($filter = null) {
        try {
            return $this->QuizDao->getList($filter);
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
            $QuizObj->setCreatedDate(Date("Y-m-d H:i:s"));
			$QuizObj->setCreatedUser($this->mUserInfo);
            return $this->QuizDao->InsertQuiz($QuizObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateQuiz($QuizObj, $Id) {
        try {
            if (!$this->validateOnUpdate($QuizObj)) { return false; }
            $QuizObjOld = $this->getQuiz($Id);
            if (!is_null($QuizObjOld)) {
				$QuizObj->setCreatedDate($QuizObjOld->getCreatedDate());
				$QuizObj->setCreatedUser($QuizObjOld->getCreatedUser());
			}
			$QuizObj->setUpdatedDate(Date("Y-m-d H:i:s"));
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
                
        if (is_null($model->getCourse()) || empty($model->getCourse())) {
            $this->addError("Course is required!");
        }
        
        
        if (is_null($model->getQuizType()) || empty($model->getQuizType())) {
            $this->addError("Quiz Type is required!");
        }
		
        if (is_null($model->getStartDateTime()) || empty($model->getStartDateTime())) {
            $this->addError("Start Date Time is required!");
        }
        
        if (is_null($model->getEndDateTime()) || empty($model->getEndDateTime())) {
            $this->addError("End Date Time is required!");
        }
        
        if (!is_null($model->getStartDateTime()) && !is_null($model->getEndDateTime())) {
            $StartDateTime = strtotime($model->getStartDateTime());
            $EndDateTime = strtotime($model->getEndDateTime());
            if ($StartDateTime > $EndDateTime) {
                $this->addError("End Date Time Smaller Than Start Date Time!");
            }
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

