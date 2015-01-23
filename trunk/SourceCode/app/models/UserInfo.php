<?php

class UserInfo {

    private $mUserName;
    private $mPassword;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mUpdatedDate;
    private $mUpdatedUser;
    private $mIsActive;
    private $mUserGroup;
    private $mIsLoaded;
    private $mFirstName;
    private $mLastName;
    private $mEmail;
    private $mCourseDetail;
    private $mInstructor;
        
    public function __construct() {
        $this->mIsLoaded = false;
    }
    
    public function setUserName($value) {
        $this->mUserName = $value;
    }

    public function getUserName() {
        return $this->mUserName;
    }
    
    public function setFirstName($value) {
        $this->mFirstName = $value;
    }

    public function getFirstName() {
        return $this->mFirstName;
    }
    
    public function setLastName($value) {
        $this->mLastName = $value;
    }

    public function getLastName() {
        return $this->mLastName;
    }
    
    public function setEmail($value) {
        $this->mEmail = $value;
    }

    public function getEmail() {
        return $this->mEmail;
    }
    
    public function setPassword($value) {
        $this->mPassword = $value;
    }

    public function getPassword() {
        return $this->mPassword;
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

    public function setUpdatedDate($value) {
        $this->mUpdatedDate = $value;
    }

    public function getUpdatedDate() {
        return $this->mUpdatedDate;
    }
   
    public function setUserGroup($value) {
        $this->mUserGroup = $value;
    }

    public function getUserGroup() {
        if (!is_null($this->mUserGroup) && !empty($this->mUserGroup)) {
            if (!$this->mUserGroup->IsLoaded()) {
                $UserGroupDao = new UserGroupDao();
                $this->mUserGroup = $UserGroupDao->getUserGroup($this->mUserGroup->getId());
                if (!is_null($this->mUserGroup)) { $this->mUserGroup->setIsLoaded(true); }
            }
        }
        return $this->mUserGroup;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
    
    public function getCourseDetail() {
        if (!is_null($this->mUserName) && !empty($this->mUserName)) {
            $CourseDetailDao = new CourseDetailDao();
            $CourseDetailFilter = new CourseDetailFilter();
            $CourseDetailFilter->setUserName($this->mUserName);
            $this->mCourseDetail = $CourseDetailDao->getList($CourseDetailFilter);
        }
        return $this->mCourseDetail;
    }
    
    public function getInstructor() {
        if (!is_null($this->mUserName) && !empty($this->mUserName)) {
            $InstructorDao = new InstructorDao();
            $InstructorFilter = new InstructorFilter();
            $InstructorFilter->setUserName($this->mUserName);
            $Instructor = $InstructorDao->getList($InstructorFilter);
            if (!is_null($Instructor) && count($Instructor) > 0) $this->mInstructor = $Instructor[0];
        }
        return $this->mInstructor;
    }
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }

    public function toArray() {
        return array(
            "user_name" => $this->mUserName,
            "first_name" => $this->mFirstName,
            "last_name" => $this->mLastName,
            "email" => $this->mEmail,
            "password" => md5($this->mPassword),
            "created_date" => $this->mCreatedDate,
            "updated_date" => $this->mUpdatedDate,
            "user_group_id" => (!is_null($this->mUserGroup) ? $this->mUserGroup->getId() : null),
            "is_active" => $this->mIsActive
        );
    }
        
}
