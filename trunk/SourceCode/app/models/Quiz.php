<?php

class Quiz {
    private $mId;
    private $mQuizName;
    private $mCourseCode;
    private $mQuizType;
    private $mStartDateTime;
    private $mEndDateTime;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mUpdateDate;
    private $mUpdateUser;
	
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setQuizName($value) {
        $this->mQuizName = $value;
    }
    
    public function getQuizName() {
        return $this->mQuizName;
    }
    
    public function setCourseCode($value) {
        $this->mCourseCode = $value;
    }
    
    public function getCourseCode() {
        return $this->mCourseCode;
    }
    
    public function setQuizType($value) {
        $this->mQuizType = $value;
    }
    
    public function getQuizType() {
        return $this->mQuizType;
    }
	
    public function setStartDateTime($value) {
        $this->mStartDateTime = $value;
    }
    
    public function getStartDateTime() {
        return $this->mStartDateTime;
    }
	
    public function setEndDateTime($value) {
        $this->mEndDateTime = $value;
    }
    
    public function getEndDateTime() {
        return $this->mEndDateTime;
    }
	
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }
    
    public function getCreatedDate() {
        return $this->mCreatedDate;
    }
	
    public function setCreatedUser($value) {
        $this->mCreatedUser = $value;
    }
    
    public function getCreatedUser() {
        return $this->mCreatedUser;
    }
	
    public function setUpdateDate($value) {
        $this->mUpdateDate = $value;
    }
    
    public function getUpdateDate() {
        return $this->mUpdateDate;
    }
	
    public function setUpdateUser($value) {
        $this->mUpdateUser = $value;
    }
    
    public function getUpdateUser() {
        return $this->mUpdateUser;
    }
	
    public function toArray() {
        return array(
            "id" => $this->mId,
            "quiz_name" => $this->mQuizName,
            "course_code" => $this->mCourseCode,
            "quiz_type_id" => $this->mQuizType,
            "start_date_time" => $this->mStartDateTime,
            "end_date_time" => $this->mEndDateTime,
            "created_date" => $this->mCreatedDate,
            "created_user" => $this->mCreatedUser,
            "update_date" => $this->mUpdateDate,
            "update_user" => $this->mUpdateUser
        );
    }
}

