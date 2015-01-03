<?php
class CommentService extends BaseService
{
	private $CommentDao;
    
    public function __construct() {
        parent::__construct();
        $this->CommentDao = new CommentDao();
    }
	public function getList() {
        try {
            return $this->CommentDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getComment($id) {
        try { 
            return $this->CommentDao->getComment($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertComment($CommentObj) {
        try {
            if (!$this->validateOnInsert($CommentObj)) { return false; }
			$CommentObj->setCreatedDate(Date("YYYY-mm-dd H:i:s"));
            return $this->CommentDao->InsertComment($CommentObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateComment($CommentObj, $Id) {
        try {
            if (!$this->CommentDao->UpdateComment($CommentObj, $Id));
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteComment($Id) {
        try {
            return $this->CommentDao->DeleteComment($Id);
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
        //$this->validateBase($model);
        return $this->getServiceState();
    }
    
    private function validateOnUpdate($model) {
        if (is_null($model)) { return false; }
        //$this->validateBase($model);
        return $this->getServiceState();
    }
}
?>