<?php

class StudentQuiz {
    private $mId;
    private $mUserInfo;
    private $mQuiz;
    private $mTotalScore;
    private $mStartDateTime;
    private $mEndDateTime;
    private $mStudentAnswers;
    private $mIsLoaded;
    
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setUserInfo($value)
	{
		$this->mUserInfo = $value;
	}
	
	public function getUserInfo()
	{
		if (!is_null($this->mUserInfo) && !empty($this->mUserInfo)) {
            if (!$this->mUserInfo->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUserInfo = $UserInfoDao->getUserInfo($this->mUserInfo->getUserName());
                if (!is_null($this->mUserInfo)) { $this->mUserInfo->setIsLoaded(true); }
            }
        }
		return $this->mUserInfo;
	}
    
    public function setQuiz($value) {
        $this->mQuiz = $value;
    }
    
    public function getQuiz() {
        if (!is_null($this->mQuiz) && !empty($this->mQuiz)) {
            if (!$this->mQuiz->IsLoaded()) {
                $QuizDao = new QuizDao();
                $this->mQuiz = $QuizDao->getQuiz($this->mQuiz->getId());
                if (!is_null($this->mQuiz)) { $this->mQuiz->setIsLoaded(true); }
            }
        }
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
    
    public function setStudentAnswers($value) {
        $this->mStudentAnswers = $value;
    }
    
    public function getStudentAnswers() {
        if (!is_null($this->mId) && is_null($this->mStudentAnswers)) {
            $StudentAnswerFilter = new StudentAnswerFilter();
            $StudentAnswerFilter->setStudentQuizId($this->mId);
            $StudentAnswerDao = new StudentAnswerDao();
            $this->mStudentAnswers = $StudentAnswerDao->getList($StudentAnswerFilter);
        }
        return $this->mStudentAnswers;
    }
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "user_name" => (!is_null($this->mUserInfo) ? $this->mUserInfo->getUserName() : null),
            "quiz_id" => (!is_null($this->mQuiz) ? $this->mQuiz->getId() : null),
            "total_score" => $this->mTotalScore,
            "start_date_time" => $this->mStartDateTime,
            "end_date_time" => $this->mEndDateTime
        );
    }
}

