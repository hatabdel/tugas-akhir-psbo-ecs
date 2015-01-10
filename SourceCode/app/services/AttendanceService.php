<?php

class AttendanceService extends BaseService {
    
    private $AttendanceDao;
    
    public function __construct() {
        parent::__construct();
        $this->AttendanceDao = new AttendanceDao();
    }
    
    public function getList() {
        try {
            return $this->AttendanceDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getAttendance($id) {
        try {
            return $this->AttendanceDao->getAttendance($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertAttendance($AttendanceObj) {
        try {
            if (!$this->validateOnInsert($AttendanceObj)) { return false; }
            $AttendanceObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $AttendanceObj->setUserInfo($this->mUserInfo);
            $result = $this->AttendanceDao->InsertAttendance($AttendanceObj);
            
            if (!is_null($this->AttendanceDao->getError()) && !empty($this->AttendanceDao->getError())) {
                $this->addError($this->AttendanceDao->getError());
            }
            
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateAttendance($AttendanceObj, $id) {
        try {
            if (!$this->validateOnUpdate($AttendanceObj)) { return false; }
            $AttendanceObjOld = $this->getAttendance($id);
            if (!is_null($AttendanceObjOld)) {
                $AttendanceObj->setCreatedDate($AttendanceObjOld->getCreatedDate());
                $AttendanceObj->setUserInfo($AttendanceObjOld->getUserInfo());
            }
            
            $result = $this->AttendanceDao->UpdateAttendance($AttendanceObj, $id);
            if (!is_null($this->AttendanceDao->getError()) && !empty($this->AttendanceDao->getError())) {
                $this->addError($this->AttendanceDao->getError());
            }
            return $result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteAttendance($Id) {
        try {
            return $this->AttendanceDao->DeleteAttendance($Id);
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

