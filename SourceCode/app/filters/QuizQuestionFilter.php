<?php

class QuizQuestionFilter {

    private $mId;
    private $mQuizQuestion;
    private $mUserGroupId;
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
    
    public function setQuizId($value) {
        $this->mQuizQuestion = $value;
    }

    public function getQuizId() {
        return $this->mQuizQuestion;
    }
    
    public function setUserGroupId($value) {
        $this->mUserGroupId = $value;
    }

    public function getUserGroupId() {
        return $this->mUserGroupId;
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
        
        if (!is_null($this->mUserGroupId) && !empty($this->mUserGroupId)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " user_group_id = '".stripslashes($this->mUserGroupId)."'";
        }
        
        if (!is_null($this->mQuizQuestion) && !empty($this->mQuizQuestion)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " quiz_id = '".stripslashes($this->mQuizQuestion)."'";
        }
        
        return $where; 
    }
}