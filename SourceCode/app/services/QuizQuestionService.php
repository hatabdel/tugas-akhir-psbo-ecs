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
            if (!$this->validateOnInsert($QuizQuestionObj)) { return false; }
            
            $this->QuizQuestionDao->BeginTransaction();
            $Result = $this->QuizQuestionDao->InsertQuizQuestion($QuizQuestionObj);
            
            if (!$Result) {
                $this->QuizQuestionDao->RollbackTransaction();
                $this->addError("Insert Data Failed");
                return false;
            }
            
            if (count($QuizQuestionObj->getAnswers()) > 0) {
                foreach ($QuizQuestionObj->getAnswers() as $item) {
                    if (is_null($item)) { continue; }
                    $item->setQuizQuestion($Result);
                    $AnswerDao = new AnswerDao();
                    $ResultAnswer = $AnswerDao->InsertAnswer($item);
                    if (!$ResultAnswer) {
                        $this->QuizQuestionDao->rollbackTransaction();
                        $this->addError("Insert Detail Data Failed");
                        return false;
                    }
                }
            }
            
            $this->QuizQuestionDao->CommitTransaction();
            return $Result;
            
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateQuizQuestion($QuizQuestionObj, $Id) {
        try {
            if (!$this->validateOnUpdate($QuizQuestionObj)) { return false; }
            return $this->SmartUpdate($QuizQuestionObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function SmartUpdate($data, $id) {
        
        $this->QuizQuestionDao->BeginTransaction();
        $result = $this->QuizQuestionDao->UpdateQuizQuestion($data, $id);
        
        if ($data->getAnswers() != null) {
            $filter = new AnswerFilter();
            $AnswerDao = new AnswerDao();
            $filter->setQuizQuestionId($data->getId());
            $answers = $AnswerDao->getList($filter);

            foreach($data->getAnswers() as $item) {
                $item->setQuizQuestion($data);
                if (($item->getId() == null) || ($item->getId() == '')) {
                    $item = $AnswerDao->InsertAnswer($item);
                    if ($item == null) {
                        $this->QuizQuestionDao->RollbackTransaction();
                        $this->addError('Gagal menambahkan answer data.');
                        return false;
                    }
                } else {
                    if (!$AnswerDao->UpdateAnswer($item, $item->getId())) {
                        $this->QuizQuestionDao->RollbackTransaction();
                        $this->addError('Gagal mengubah answer data.');
                        return false;
                    }
                    if (($answers != null) && (count($answers) > 0)) {
                        $to_be_removed = -1;

                        foreach($answers as $index=>$answer) {
                            if ($answer->getId() == $item->getId()) {
                                $to_be_removed = $index;
                                break;
                            }
                        }
                        if ($to_be_removed > -1) {
                            unset($answers[$to_be_removed]);
                        }
                    }
                }
            }

            if (($answers != null) && (count($answers) > 0)) {
                foreach($answers as $item) {
                    if (!$AnswerDao->DeleteAnswer($item->getId())) {
                        $this->QuizQuestionDao->RollbackTransaction();
                        $this->addError('Gagal menghapus unused answer data.');
                        return false;
                    }
                }
            }
            
        }
        $this->QuizQuestionDao->CommitTransaction();
        return $result;
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
                
        if (is_null($model->getQuestion()) || empty($model->getQuestion())) {
            $this->addError("Question is required!");
        }
        
        if (is_null($model->getScore()) || empty($model->getScore())) {
            $this->addError("Score is required!");
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

