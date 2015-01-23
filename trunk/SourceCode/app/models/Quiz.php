<?php

class Quiz {
    private $mId;
    private $mQuizName;
    private $mCourse;
    private $mQuizType;
    private $mStartDateTime;
    private $mEndDateTime;
    private $mQuizTime;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mUpdatedDate;
    private $mUpdatedUser;
    private $mQuizDetails;
    private $mTotalScore;
    private $mIsLoaded;
	
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
    
    public function setCourse($value) {
        $this->mCourse = $value;
    }
    
    public function getCourse() {
        if (!is_null($this->mCourse) && !empty($this->mCourse)) {
            if (!$this->mCourse->IsLoaded()) {
                $CourseDao = new CourseDao();
                $this->mCourse = $CourseDao->getCourse($this->mCourse->getCode());
                if (!is_null($this->mCourse)) { $this->mCourse->setIsLoaded(true); }
            }
        }
		return $this->mCourse;
    }
    
    public function setQuizType($value) {
        $this->mQuizType = $value;
    }
    
    public function getQuizType() {
        if (!is_null($this->mQuizType) && !empty($this->mQuizType)) {
            if (!$this->mQuizType->IsLoaded()) {
                $QuizTypeDao = new QuizTypeDao();
                $this->mQuizType = $QuizTypeDao->getQuizType($this->mQuizType->getId());
                if (!is_null($this->mQuizType)) { $this->mQuizType->setIsLoaded(true); }
            }
        }
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
	
    public function setQuizTime($value) {
        $this->mQuizTime = $value;
    }
    
    public function getQuizTime() {
        return $this->mQuizTime;
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
        if (!is_null($this->mCreatedUser) && !empty($this->mCreatedUser)) {
            if (!$this->mCreatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUser->getUserName());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
		return $this->mCreatedUser;
    }
	
    public function setUpdatedDate($value) {
        $this->mUpdatedDate = $value;
    }
    
    public function getUpdatedDate() {
        return $this->mUpdatedDate;
    }
	
    public function setUpdatedUser($value) {
        $this->mUpdatedUser = $value;
    }
    
    public function getUpdateUser() {
        if (!is_null($this->mUpdatedUser) && !empty($this->mUpdatedUser)) {
            if (!$this->mUpdatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUpdatedUser = $UserInfoDao->getUserInfo($this->mUpdatedUser->getUserName());
                if (!is_null($this->mUpdatedUser)) { $this->mUpdatedUser->setIsLoaded(true); }
            }
        }
		return $this->mUpdatedUser;
    }
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function getQuizDetail() {
        if (!is_null($this->mId)) {
            $QuizQuestionFilter = new QuizQuestionFilter();
            $QuizQuestionFilter->setQuizId($this->mId);
            $QuizQuestionDao = new QuizQuestionDao();
            $this->mQuizDetails = $QuizQuestionDao->getList($QuizQuestionFilter);
        }
        return $this->mQuizDetails;
    }
	
    public function getTotalScore() {
        if (!is_null($this->mId)) {
            $QuizQuestionFilter = new QuizQuestionFilter();
            $QuizQuestionFilter->setQuizId($this->mId);
            $QuizQuestionDao = new QuizQuestionDao();
            $result = $QuizQuestionDao->getList($QuizQuestionFilter);
            $this->mTotalScore = 0;
            if (!is_null($result)) {
                foreach($result as $item) {
                    $this->mTotalScore += $item->getScore();
                }
            }
        }
        return $this->mTotalScore;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "quiz_name" => $this->mQuizName,
            "course_code" => (!is_null($this->mCourse) ? $this->mCourse->getCode() : null),
            "quiz_type_id" => (!is_null($this->mQuizType) ? $this->mQuizType->getId() : null),
            "start_date_time" => $this->mStartDateTime,
            "end_date_time" => $this->mEndDateTime,
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "updated_date" => $this->mUpdatedDate,
            "updated_user" => (!is_null($this->mUpdatedUser) ? $this->mUpdatedUser->getUserName() : null),
            "quiz_time" => $this->mQuizTime,
        );
    }
}

