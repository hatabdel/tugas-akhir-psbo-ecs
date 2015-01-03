<?php

class UserInfo {

    private $mUserName;
    private $mPassword;
    private $mCreatedDate;
    private $mIsActive;
    private $mUserGroup;
    private $mIsLoaded;
    
    public function __construct() {
        $this->mIsLoaded = false;
    }
    
    public function setUserName($value) {
        $this->mUserName = $value;
    }

    public function getUserName() {
        return $this->mUserName;
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
    
    public function setUserGroup($value) {
        $this->mUserGroup = $value;
    }

    public function getUserGroup() {
        return $this->mUserGroup;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
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
            "password" => md5($this->mPassword),
            "created_date" => $this->mCreatedDate,
            "user_group_id" => $this->mUserGroup,
            "is_active" => $this->mIsActive
        );
    }
        
}
