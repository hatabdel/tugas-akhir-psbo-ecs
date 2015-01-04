<?php

class AnswerService extends BaseService {
    
    private $AnswerDao;
    
    public function __construct() {
        parent::__construct();
        $this->AnswerDao = new AnswerDao();
    }
    
    public function getList() {
        try {
            return $this->AnswerDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getAnswer($id) {
        try { 
            return $this->AnswerDao->getAnswer($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertAnswer($AnswerObj) {
        try {
            if (!$this->validateOnInsert($AnswerObj)) { return false; }
            return $this->AnswerDao->InsertAnswer($AnswerObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateAnswer($AnswerObj, $Id) {
        try {
            if (!$this->validateOnUpdate($AnswerObj)) { return false; }
            return $this->AnswerDao->UpdateAnswer($AnswerObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteAnswer($Id) {
        try {
            return $this->AnswerDao->DeleteAnswer($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getSequence()) || empty($model->getSequence())) {
            $this->addError("Sequence is required!");
        }
        
        
        if (is_null($model->getQuizQuestionId()) || empty($model->getQuizQuestionId())) {
            $this->addError("Quiz Question Id is required!");
        }
        
        
        if (is_null($model->getContent()) || empty($model->getContent())) {
            $this->addError("Content is required!");
        }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		
		if (!is_null($model->getId()) && !empty($model->getId())) {
            $AnswerObj = $this->getAnswer($model->getId());
            if (!is_null($AnswerObj)) {
                $this->addError("Data with code ".$model->getId()." is already exist!");
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

