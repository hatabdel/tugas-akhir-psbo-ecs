<?php

class Attendance{

    private $mId;
    private $mUserInfo;
    private $mWebinar;
    private $mCreatedDate;
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
    
    public function setWebinar($value) {
        $this->mWebinar = $value;
    }

    public function getWebinar() {
        if (!is_null($this->mWebinar) && !empty($this->mWebinar)) {
            if (!$this->mWebinar->IsLoaded()) {
                $WebinarDao = new WebinarDao();
                $this->mWebinar = $WebinarDao->getWebinar($this->mWebinar->getUserName());
                if (!is_null($this->mWebinar)) { $this->mWebinar->setIsLoaded(true); }
            }
        }
        return $this->mWebinar;
    }
    
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }
    
    public function getCreatedDate() {
        return $this->mCreatedDate;
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
            "webinar_id" => (!is_null($this->mWebinar) ? $this->mWebinar->getId() : null),
            "created_date" => $this->mCreatedDate,
        );
    }
        
}
