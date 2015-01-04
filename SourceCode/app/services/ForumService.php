<?php
class ForumService extends BaseService
{
	private $ForumDao;
    
    public function __construct() {
        parent::__construct();
        $this->ForumDao = new ForumDao();
    }
	public function getList() {
        try {
            return $this->ForumDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getForum($id) {
        try { 
            return $this->ForumDao->getForum($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertForum($ForumObj) {
        try {
            if (!$this->validateOnInsert($ForumObj)) { return false; }
			$ForumObj->setCreatedDate(Date("Y-m-d H:i:s"));
			$ForumObj->setCreatedUser($this->mUserInfo);
            return $this->ForumDao->InsertForum($ForumObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateForum($ForumObj, $Id) {
        try {
            if (!$this->validateOnUpdate($ForumObj)) { return false; }
			$ForumObjOld = $this->getForum($Id);
			if (!is_null($ForumObjOld)) {
				$ForumObj->setCreatedDate($ForumObjOld->getCreatedDate());
				$ForumObj->setCreatedUser($ForumObjOld->getCreatedUser());
			}
			$ForumObj->setUpdatedDate(Date("Y-m-d H:i:s"));
            return $this->ForumDao->UpdateForum($ForumObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteForum($Id) {
        try {
            return $this->ForumDao->DeleteForum($Id);
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
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		if (!is_null($model->getId()) && !empty($model->getId())) {
            $ForumObj = $this->getForum($model->getId());
            if (!is_null($ForumObj)) {
                $this->addError("Data with id ".$model->getId()." is already exist!");
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
?>