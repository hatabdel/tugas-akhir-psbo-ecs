<?php

class Identity {

    private $mId;
    private $mIdentityNo;
    private $mFirstName;
    private $mLastName;
    private $mAddress;
    private $mBirthPlace;
    private $mBirthDate;
    private $mHandphoneNo;
    private $mEmail;
    private $mCreateDate;
    private $mListOfCourseDetail;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setIdentityNo($value) {
        $this->mIdentityNo = $value;
    }

    public function getIdentityNo() {
        return $this->mIdentityNo;
    }
    
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }

    public function getCreatedDate() {
        return $this->mCreatedDate;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
}
