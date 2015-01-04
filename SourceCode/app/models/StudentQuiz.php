<?php

class StudentQuiz {
    private $mStudentQuiz;
    private $mIdentity;
    private $mQuiz;
    private $mTotalScore;
    private $mStartDateTime;
    private $mEndDateTime;
    
    public function setStudentQuiz($value) {
        $this->mStudentQuiz = $value;
    }
    
    public function getStudentQuiz() {
        return $this->mStudentQuiz;
    }
    
    public function setIdentity($value) {
        $this->mIdentity = $value;
    }
    
    public function getIdentity() {
        return $this->mIdentity;
    }
    
    public function setQuiz($value) {
        $this->mQuiz = $value;
    }
    
    public function getQuiz() {
        return $this->mQuiz;
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
            "id" => $this->mStudentQuiz,
            "identity_id" => $this->mIdentity,
            "quiz_id" => $this->mQuiz,
            "total_score" => $this->mTotalScore,
            "start_date_time" => $this->mStartDateTime,
            "end_date_time" => $this->mEndDateTime
        );
    }
}

