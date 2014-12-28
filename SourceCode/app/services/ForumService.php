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
            return $this->ForumDao->InsertForum($ForumObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateForum($ForumObj, $Id) {
        try {
            if (!$this->ForumDao->UpdateForum($ForumObj, $Id));
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
    
    /*private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        if (is_null($model->getTitle()) || empty($model->getTitle())) {
            $this->addError("Title is required!");
        }
        
        return $this->getServiceState();
    }*/
    
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
?>