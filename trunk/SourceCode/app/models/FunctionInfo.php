<?php

class FunctionInfo {
    private $mFunctionId;
    private $mName;
    private $mUrl;
    private $mIsActive;
    private $mIsShow;
    private $mIsLoaded;
    
    public function __construct() {
        $this->mIsLoaded = false;
    }
    
    public function setFunctionId($value) {
        $this->mFunctionId = $value;
    }
    
    public function getFunctionId() {
        return $this->mFunctionId;
    }
    
    public function setName($value) {
        $this->mName = $value;
    }
    
    public function getName() {
        return $this->mName;
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
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function toArray() {
        return array(
            "function_id" => $this->mFunctionId,
            "name" => $this->mName,
            "url" => $this->mUrl,
            "is_active" => $this->mIsActive,
            "is_show" => $this->mIsShow
        );
    }
}

