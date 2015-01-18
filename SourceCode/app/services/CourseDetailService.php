<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CourseDetailService extends BaseService {
    
    private $CourseDetailDao;
    
    public function __construct() {
        parent::__construct();
        $this->CourseDetailDao = new CourseDetailDao();
    }
    
    public function getList() {
        try {
            return $this->CourseDetailDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getCourseDetail($id) {
        try { 
            return $this->CourseDetailDao->getCourseDetail($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertCourseDetail($CourseDetailObj) {
        try {
            if (!$this->validateOnInsert($CourseDetailObj)) { return false; }
            return $this->CourseDetailDao->InsertCourseDetail($CourseDetailObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateCourseDetail($CourseDetailObj, $Id) {
        try {
            if (!$this->validateOnUpdate($CourseDetailObj)) { return false; }
            return $this->CourseDetailDao->UpdateCourseDetail($CourseDetailObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteCourseDetail($Id) {
        try {
            return $this->CourseDetailDao->DeleteCourseDetail($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
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

