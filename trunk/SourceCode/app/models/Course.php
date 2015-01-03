<?php

class Course {

    private $mCode;
    private $mName;
    private $mDescription;
    private $mStartDate;
    private $mEndDate;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mIsActive;
    
    public function setCode($value) {
        $this->mCode = $value;
    }

    public function getCode() {
        return $this->mCode;
    }
    
    public function setName($value) {
        $this->mName = $value;
    }

    public function getName() {
        return $this->mName;
    }
    
    public function setDescription($value) {
        $this->mDescription = $value;
    }

    public function getDescription() {
        return $this->mDescription;
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
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUse->getUserName());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
        return $this->mCreatedUser;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
    
    public function toArray() {
        return array(
            "code" => $this->mCode,
            "name" => $this->mName,
            "description" => $this->mDescription,
            "start_date" => $this->mStartDate,
            "end_date" => $this->mEndDate,
            "created_date" => $this->mCreatedDate,
            "created_user"=> (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "is_active" => $this->mIsActive
        );
    }
}
