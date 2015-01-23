<?php

class StudentAnswerFilter {

    private $mId;
    private $mStudentQuiz;
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
    
    public function setStudentQuizId($value) {
        $this->mStudentQuiz = $value;
    }

    public function getStudentQuizId() {
        return $this->mStudentQuiz;
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
        
        if (!is_null($this->mStudentQuiz) && !empty($this->mStudentQuiz)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " student_quiz_id = '".stripslashes($this->mStudentQuiz)."'";
        }
        
        return $where; 
    }
}