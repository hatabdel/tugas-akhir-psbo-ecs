<?php

class CourseDetail {

    private $mId;
    private $mIdentityId;
    private $mCourseCode;
    private $mCreatedDate;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setIdentityId($value) {
        $this->mIdentityId = $value;
    }

    public function getIdentityId() {
        return $this->mIdentityId;
    }
    
    public function setCourseCode($value) {
        $this->mCourseCode = $value;
    }

    public function getCourseCode() {
        return $this->mCourseCode;
    }
    
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }

    public function getCreatedDate() {
        return $this->mCreatedDate;
    }
    
}
