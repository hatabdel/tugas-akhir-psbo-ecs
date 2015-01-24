<?php

class CourseService extends BaseService {
    
    private $CourseDao;
    
    public function __construct() {
        parent::__construct();
        $this->CourseDao = new CourseDao();
    }
    
    public function getList($filter = null) {
        try {
            return $this->CourseDao->getList($filter);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getCourse($id) {
        try { 
            return $this->CourseDao->getCourse($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertCourse($CourseObj) {
        try {
            if (!$this->validateOnInsert($CourseObj)) { return false; }
            $CourseObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $CourseObj->setCreatedUser($this->mUserInfo);
            return $this->CourseDao->InsertCourse($CourseObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateCourse($CourseObj, $Id) {
        try {
            if (!$this->validateOnUpdate($CourseObj)) { return false; }
            $CourseObjOld = $this->getCourse($Id);
            if (!is_null($CourseObjOld)) {
                $CourseObj->setCreatedDate($CourseObjOld->getCreatedDate());
                $CourseObj->setCreatedUser($CourseObjOld->getCreatedUser());
            }
            return $this->CourseDao->UpdateCourse($CourseObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteCourse($Id) {
        try {
            return $this->CourseDao->DeleteCourse($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function createCriteria($filter) {
        
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getCode()) || empty($model->getCode())) {
            $this->addError("Code is required!");
        }
        
        if (is_null($model->getName()) || empty($model->getName())) {
            $this->addError("Name is required!");
        }
        
        
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        
        if (!is_null($model->getCode()) && !empty($model->getCode())) {
            $CourseObj = $this->getCourse($model->getCode());
            if (!is_null($CourseObj)) {
                $this->addError("Data with code ".$model->getCode()." is already exist!");
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

