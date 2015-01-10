<?php

class Webinar {

    private $mId;
    private $mTitle;
    private $mCourse;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mStartDate;
    private $mEndDate;
    private $mIsLoaded;
    
    public function __construct() {
        $this->mIsLoaded = false;
    }
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setTitle($value) {
        $this->mTitle = $value;
    }

    public function getTitle() {
        return $this->mTitle;
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
                $CreatedUserDao = new UserInfoDao();
                $this->mCreatedUser = $CreatedUserDao->getUserInfo($this->mCreatedUser->getUserName());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
        return $this->mCreatedUser;
    }

    public function setStartDate($value) {
        $this->mStartDate = $value;
    }

    public function getStartDate() {
        return $this->mStartDate;
    }
    
    public function setEndDate($value) {
        $this->mEndDate = $value;
    }

    public function getEndDate() {
        return $this->mEndDate;
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
            "title" => $this->mTitle,
            "course_code" => (!is_null($this->mCourse) ? $this->mCourse->getCode() : null),
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "start_date" => $this->mStartDate,
            "end_date" => $this->mEndDate
        );
    }
        
}
