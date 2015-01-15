<?php

class ModuleInfoService extends BaseService {
    
    private $ModuleInfoDao;
    
    public function __construct() {
        parent::__construct();
        $this->ModuleInfoDao = new ModuleInfoDao();
    }
    
    public function getList() {
        try {
            return $this->ModuleInfoDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getModuleInfo($id) {
        try { 
            return $this->ModuleInfoDao->getModuleInfo($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertModuleInfo($ModuleInfoObj) {
        try {
            if (!$this->validateOnInsert($ModuleInfoObj)) { return false; }
            $Result = $this->ModuleInfoDao->InsertModuleInfo($ModuleInfoObj);
            
            if (count($ModuleInfoObj->getPrivilegeInfos()) > 0) {
                foreach ($ModuleInfoObj->getPrivilegeInfos() as $item) {
                    if (is_null($item)) { continue; }
                    $item->setModuleInfo($Result);
                    $PrivilegeInfoDao = new PrivilegeInfoDao();
                    $PrivilegeInfoDao->InsertPrivilegeInfo($item);
                }
            }
            
            return $Result;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateModuleInfo($ModuleInfoObj, $Id) {
        try {
            if (!$this->validateOnUpdate($ModuleInfoObj)) { return false; }
            return $this->ModuleInfoDao->UpdateModuleInfo($ModuleInfoObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteModuleInfo($Id) {
        try {
            return $this->ModuleInfoDao->DeleteModuleInfo($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getName()) || empty($model->getName())) {
            $this->addError("Name is required!");
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

