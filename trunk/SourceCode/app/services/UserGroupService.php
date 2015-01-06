<?php

class UserGroupService extends BaseService {
    
    private $UserGroupDao;
    
    public function __construct() {
        parent::__construct();
        $this->UserGroupDao = new UserGroupDao();
    }
    
    public function getList() {
        try {
            return $this->UserGroupDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getUserGroup($id) {
        try { 
            return $this->UserGroupDao->getUserGroup($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertUserGroup($UserGroupObj) {
        try {
            if (!$this->validateOnInsert($UserGroupObj)) { return false; }
            $Result = $this->UserGroupDao->InsertUserGroup($UserGroupObj);
            
            if (count($UserGroupObj->getPrivilegeInfos()) > 0) {
                foreach ($UserGroupObj->getPrivilegeInfos() as $item) {
                    if (is_null($item)) { continue; }
                    $item->setUserGroup($Result);
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
    
    public function UpdateUserGroup($UserGroupObj, $Id) {
        try {
            if (!$this->validateOnUpdate($UserGroupObj)) { return false; }
            return $this->SmartUpdate($UserGroupObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteUserGroup($Id) {
        try {
            return $this->UserGroupDao->DeleteUserGroup($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    private function SmartUpdate($data, $id) {
        $result = $this->UserGroupDao->UpdateUserGroup($data, $id);
        
        if ($data->getPrivilegeInfos() != null) {
            $filter = new PrivilegeInfoFilter();
            $PrivilegeInfoDao = new PrivilegeInfoDao();
            $filter->setUserGroupId($data->getId());
            $privileges = $PrivilegeInfoDao->getList($filter);

            foreach($data->getPrivilegeInfos() as $item) {
                $item->setUserGroup($data);
                if (($item->getId() == null) || ($item->getId() == '')) {
                    $item = $PrivilegeInfoDao->InsertPrivilegeInfo($item);
                    if ($item == null) {
                        $this->addError('Gagal menambahkan privilege data.');
                        return false;
                    }
                } else {
                    if (!$PrivilegeInfoDao->UpdatePrivilegeInfo($item, $item->getId())) {
                        $this->addError('Gagal mengubah privilege data.');
                        return false;
                    }
                    if (($privileges != null) && (count($privileges) > 0)) {
                        $to_be_removed = -1;

                        foreach($privileges as $index=>$privilege) {
                            if ($privilege->getId() == $item->getId()) {
                                $to_be_removed = $index;
                                break;
                            }
                        }
                        if ($to_be_removed > -1) {
                            unset($privileges[$to_be_removed]);
                        }
                    }
                }
            }

            if (($privileges != null) && (count($privileges) > 0)) {
                foreach($privileges as $item) {
                    if (!$PrivilegeInfoDao->DeletePrivilegeInfo($item->getId())) {
                        $this->addError('Gagal menghapus unused privilege data.');
                        return false;
                    }
                }
            }

        }
        return $result;
    }
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        /*if (is_null($model->getName()) || empty($model->getName())) {
            $this->addError("Name is required!");
        }*/
        
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

