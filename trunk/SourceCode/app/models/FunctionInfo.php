<?php

class FunctionInfo {
    private $mFunctionId;
    private $mName;
    private $mRoute;
    private $mModuleInfo;
    private $mIcon;
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
    
    public function setRoute($value) {
        $this->mRoute = $value;
    }
    
    public function getRoute() {
        return $this->mRoute;
    }
    
    public function setModuleInfo($value) {
        $this->mModuleInfo = $value;
    }
    
    public function getModuleInfo() {
        if (!is_null($this->mModuleInfo) && !empty($this->mModuleInfo)) {
            if (!$this->mModuleInfo->IsLoaded()) {
                $ModuleInfoDao = new ModuleInfoDao();
                $this->mModuleInfo = $ModuleInfoDao->getModuleInfo($this->mModuleInfo->getId());
                if (!is_null($this->mModuleInfo)) { $this->mModuleInfo->setIsLoaded(true); }
            }
        }
        return $this->mModuleInfo;
    }
    
    public function setIcon($value) {
        $this->mIcon = $value;
    }
    
    public function getIcon() {
        return $this->mIcon;
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
            "route" => $this->mRoute,
            "icon" => $this->mIcon,
            "module_info_id" => (!is_null($this->mModuleInfo) ? $this->mModuleInfo->getId() : null),
            "url" => $this->mUrl,
            "is_active" => $this->mIsActive,
            "is_show" => $this->mIsShow
        );
    }
}

