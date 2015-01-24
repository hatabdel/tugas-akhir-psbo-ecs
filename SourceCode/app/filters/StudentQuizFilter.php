<?php

class StudentQuizFilter {

    private $mId;
    private $mUserName;
    private $mQuizId;
    private $mIsAllowRead;
	private $mIsAllowCreate;
	private $mIsAllowUpdate;
	private $mIsAllowDelete;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setUserName($value) {
        $this->mUserName = $value;
    }

    public function getUserName() {
        return $this->mUserName;
    }
    
    public function setQuizId($value) {
        $this->mQuizId = $value;
    }

    public function getQuizId() {
        return $this->mQuizId;
    }
    
    public function setIsAllowRead($value) {
        $this->mIsAllowRead = $value;
    }

    public function IsAllowRead() {
        return $this->mIsAllowRead;
    }
	
	public function setIsAllowCreate($value) {
        $this->mIsAllowCreate = $value;
    }

    public function IsAllowCreate() {
        return $this->mIsAllowCreate;
    }
	
	public function setIsAllowUpdate($value) {
        $this->mIsAllowUpdate = $value;
    }

    public function IsAllowUpdate() {
        return $this->mIsAllowUpdate;
    }
	
	public function setIsAllowDelete($value) {
        $this->mIsAllowDelete = $value;
    }

    public function IsAllowDelete() {
        return $this->mIsAllowDelete;
    }
    
    public function getWhereQuery() {
        $where = "";
        
        if (!is_null($this->mQuizId) && !empty($this->mQuizId)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " quiz_id = '".stripslashes($this->mQuizId)."'";
        }
        
        if (!is_null($this->mUserName) && !empty($this->mUserName)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " user_name = '".stripslashes($this->mUserName)."'";
        }
        
        return $where; 
    }
}