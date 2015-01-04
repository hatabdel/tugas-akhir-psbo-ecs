<?php

class StudentQuiz {
    private $mStudentQuizId;
    private $mIdentityId;
    private $mQuizId;
    private $mTotalScore;
    private $mStartDateTime;
    private $mEndDateTime;
    
    public function setStudentQuizId($value) {
        $this->mStudentQuizId = $value;
    }
    
    public function getStudentQuizId() {
        return $this->mStudentQuizId;
    }
    
    public function setIdentityId($value) {
        $this->mIdentityId = $value;
    }
    
    public function getIdentityId() {
        return $this->mIdentityId;
    }
    
    public function setQuizId($value) {
        $this->mQuizId = $value;
    }
    
    public function getQuizId() {
        return $this->mQuizId;
    }
    
    public function setTotalScore($value) {
        $this->mTotalScore = $value;
    }
    
    public function getTotalScore() {
        return $this->mTotalScore;
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
    
    public function toArray() {
        return array(
            "student_quiz_id" => $this->mStudentQuizId,
            "identity_id" => $this->mIdentityId,
            "quiz_id" => $this->mQuizId,
            "total_score" => $this->mTotalScore,
            "start_date_time" => $this->mStartDateTime,
            "end_date_time" => $this->mEndDateTime
        );
    }
}

