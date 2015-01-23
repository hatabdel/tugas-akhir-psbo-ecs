<?php

class AnswerFilter {

    private $mId;
    private $mQuizQuestion;
    private $mUserGroupId;
    private $mIsCorrect;
	private $mIsAllowCreate;
	private $mIsAllowUpdate;
	private $mIsAllowDelete;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setQuizQuestionId($value) {
        $this->mQuizQuestion = $value;
    }

    public function getQuizQuestionId() {
        return $this->mQuizQuestion;
    }
    
    public function setUserGroupId($value) {
        $this->mUserGroupId = $value;
    }

    public function getUserGroupId() {
        return $this->mUserGroupId;
    }
    
    public function setIsCorrect($value) {
        $this->mIsCorrect = $value;
    }

    public function IsCorrect() {
        return $this->mIsCorrect;
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
        
        if (!is_null($this->mIsCorrect) && !empty($this->mIsCorrect)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " is_correct = '".stripslashes($this->mIsCorrect)."'";
        }
        
        if (!is_null($this->mQuizQuestion) && !empty($this->mQuizQuestion)) {
            if (!empty($where)) { $where .= " AND "; }
            $where .= " quiz_question_id = '".stripslashes($this->mQuizQuestion)."'";
        }
        
        return $where; 
    }
}