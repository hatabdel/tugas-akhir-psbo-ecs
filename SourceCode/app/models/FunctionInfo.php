<?php

class FunctionInfo {
    private $mFunctionId;
    private $mUrl;
    private $mIsActive;
    private $mIsShow;
    
    public function setFunctionId($value) {
        $this->mFunctionId = $value;
    }
    
    public function getFunctionId() {
        return $this->mFunctionId;
    }
    
    public function setUrl($value) {
        $this->mUrl = $value;
    }
    
    public function getUrl() {
        return $this->mUrl;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }
    
    public function IsActive() {
        return $this->mIsActive;
    }
    
    public function setIsShow($value) {
        $this->mIsShow = $value;
    }
    
    public function IsShow() {
        return $this->mIsShow;
    }
}

