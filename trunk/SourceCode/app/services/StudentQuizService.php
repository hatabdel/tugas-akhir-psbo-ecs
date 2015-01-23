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
            if (!$this->validateOnInsert($StudentQuizObj)) { return false; }
            
            $this->StudentQuizDao->BeginTransaction();
            
            $StudentQuizObj->setUserInfo($this->mUserInfo);
            $StudentQuizObj->setEndDateTime(Date("Y-m-d H:i:s"));
            
            $StudentAnswer = array();
            $TotalScore = 0;
            foreach ($StudentQuizObj->getStudentAnswers() as $item) {
                if (is_null($item)) continue;
                $QuestionAnswer = (!is_null($item->getQuizQuestion()) ? $item->getQuizQuestion()->getCorrectAnswers() : array());
                $Score = (!is_null($item->getQuizQuestion()) ? $item->getQuizQuestion()->getScore() : 0);
                $AnswerId = (!is_null($item->getAnswer()) ? $item->getAnswer()->getId() : "");
                if (in_array($AnswerId, $QuestionAnswer)) {
                    $item->setScore($Score);
                    $item->setIsCorrect(true);
                    $TotalScore += $Score;
                } else {
                    $item->setScore(0);
                    $item->setIsCorrect(false);
                }
                $StudentAnswer[] = $item;
            }
            $StudentQuizObj->setTotalScore($TotalScore);
            $StudentQuizObj->setStudentAnswers($StudentAnswer);
            
            $Result = $this->StudentQuizDao->InsertStudentQuiz($StudentQuizObj);
            
            if (!$Result) {
                $this->StudentQuizDao->RollbackTransaction();
                $this->addError("Insert Data Failed");
                return false;
            }
            
            if (count($StudentQuizObj->getStudentAnswers()) > 0) {
                foreach ($StudentQuizObj->getStudentAnswers() as $item) {
                    if (is_null($item)) { continue; }
                    $item->setStudentQuiz($Result);
                    $StudentAnswerDao = new StudentAnswerDao();
                    $ResultStudentAnswer = $StudentAnswerDao->InsertStudentAnswer($item);
                    if (!$ResultStudentAnswer) {
                        $this->StudentQuizDao->rollbackTransaction();
                        $this->addError("Insert Detail Data Failed");
                        return false;
                    }
                }
            }
            
            $this->StudentQuizDao->CommitTransaction();
            return $Result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateStudentQuiz($StudentQuizObj, $Id) {
        try {
            if (!$this->validateOnUpdate($StudentQuizObj)) { return false; }
            return $this->StudentQuizDao->UpdateStudentQuiz($StudentQuizObj, $Id);
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


