<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AttachmentService extends BaseService {
    private $AttachmentDao;
    
    public function __construct() {
        parent::__construct();
        $this->AttachmentDao = new AttachmentDao();
    }
    
    public function getList($filter = null) {
        try {
            return $this->AttachmentDao->getList($filter);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getAttachment($id) {
        try { 
            return $this->AttachmentDao->getAttachment($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertAttachment($AttachmentObj) {
        try {
            if (!$this->validateOnInsert($AttachmentObj)) { return false; }
            
            $AttachmentObj->setCreatedDate(Date("Y-m-d H:i:s"));
            $AttachmentObj->setCreatedUser($this->mUserInfo);
            
			return $this->AttachmentDao->InsertAttachment($AttachmentObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateAttachment($AttachmentObj, $Id) {
        try {
            if (!$this->validateOnUpdate($AttachmentObj)) { return false; }
            return $this->AttachmentDao->UpdateAttachment($AttachmentObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteAttachment($Id) {
        try {
            return $this->AttachmentDao->DeleteAttachment($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getFileName()) || empty($model->getFileName())) {
            $this->addError("File Name is required!");
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

