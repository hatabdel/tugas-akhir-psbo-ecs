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
    private $mListOfInstructor;
    
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

    public function getCreatedUser() {
        return $this->mCreatedUser;
    }
    
    public function setCreatedUser($value) {
        $this->mCreatedUser = $value;
    }

    public function getCreatedUser() {
        return $this->mCreatedUser;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
    
    public function setListOfInstructor($value) {
        $this->mListOfInstructor = $value;
    }

    public function ListOfInstructor() {
        return $this->mListOfInstructor;
    }
}
