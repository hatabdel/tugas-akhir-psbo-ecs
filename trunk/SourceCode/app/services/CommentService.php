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
    
    public function getListPaging($filter = null, $limit = 0, $offset = 0) {
        try {
            return $this->CommentDao->getListPaging($filter, $limit, $offset);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getListCount($filter = null) {
        try {
            return $this->CommentDao->getListCount($filter);
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
			$CommentObj->setCreatedDate(Date("Y-m-d H:i:s"));
			$CommentObj->setCreatedUser($this->mUserInfo);
            return $this->CommentDao->InsertComment($CommentObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateComment($CommentObj, $Id) {
        try {
            if (!$this->validateOnUpdate($CommentObj)) { return false; }
            $CommentObjOld = $this->getComment($Id);
            if (!is_null($CommentObjOld)) {
                $CommentObj->setCreatedDate($CommentObjOld->getCreatedDate());
                $CommentObj->setCreatedUser($CommentObjOld->getCreatedUser());
            }
			$CommentObj->setUpdatedDate(Date("Y-m-d H:i:s"));
            return $this->CommentDao->UpdateComment($CommentObj, $Id);
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
    
    private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		if (!is_null($model->getId()) && !empty($model->getId())) {
            $CommentObj = $this->getComment($model->getId());
            if (!is_null($CommentObj)) {
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