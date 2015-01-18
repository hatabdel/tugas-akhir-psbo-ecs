<?php

class CourseDetail {

    private $mId;
    private $mUserInfo;
    private $mCourse;
    private $mJoinDate;
    private $mIsLoaded;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setUserInfo($value) {
        $this->mUserInfo = $value;
    }

    public function getUserInfo() {
        if (!is_null($this->mUserInfo) && !empty($this->mUserInfo)) {
            if (!$this->mUserInfo->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUserInfo = $UserInfoDao->getUserInfo($this->mUserInfo->getUserName());
                if (!is_null($this->mUserInfo)) { $this->mUserInfo->setIsLoaded(true); }
            }
        }
        return $this->mUserInfo;
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
    
    public function setJoinDate($value) {
        $this->mJoinDate = $value;
    }

    public function getJoinDate() {
        return $this->mJoinDate;
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
            "user_name"=> (!is_null($this->mUserInfo) ? $this->mUserInfo->getUserName() : null),
            "course_code"=> (!is_null($this->mCourse) ? $this->mCourse->getCode() : null),
            "join_date" => $this->mJoinDate
        );
    }
}
