<?php

class WebinarService extends BaseService {
    
    private $WebinarDao;
    
    public function __construct() {
        parent::__construct();
        $this->WebinarDao = new WebinarDao();
    }
    
    public function getList() {
        try {
            return $this->WebinarDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getWebinar($id) {
        try {
            return $this->WebinarDao->getWebinar($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertWebinar($WebinarObj) {
        try {
            if (!$this->validateOnInsert($WebinarObj)) { return false; }
            $WebinarObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $WebinarObj->setCreatedUser($this->mUserInfo);
            $result = $this->WebinarDao->InsertWebinar($WebinarObj);
            
            if (!is_null($this->WebinarDao->getError()) && !empty($this->WebinarDao->getError())) {
                $this->addError($this->WebinarDao->getError());
            }
            
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateWebinar($WebinarObj, $id) {
        try {
            if (!$this->validateOnUpdate($WebinarObj)) { return false; }
            $WebinarObjOld = $this->getWebinar($id);
            if (!is_null($WebinarObjOld)) {
                $WebinarObj->setCreatedDate($WebinarObjOld->getCreatedDate());
                $WebinarObj->setCreatedUser($WebinarObjOld->getCreatedUser());
            }
            
            $result = $this->WebinarDao->UpdateWebinar($WebinarObj, $id);
            if (!is_null($this->WebinarDao->getError()) && !empty($this->WebinarDao->getError())) {
                $this->addError($this->WebinarDao->getError());
            }
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteWebinar($Id) {
        try {
            return $this->WebinarDao->DeleteWebinar($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getTitle()) || empty($model->getTitle())) {
            $this->addError("Title is required!");
        }
        
        if (is_null($model->getStartDate()) || empty($model->getStartDate())) {
            $this->addError("Start Date is required!");
        }
        
        if (is_null($model->getEndDate()) || empty($model->getEndDate())) {
            $this->addError("End Date is required!");
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

