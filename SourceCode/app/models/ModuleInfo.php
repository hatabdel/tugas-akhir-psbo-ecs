<?php

class ModuleInfo {

    private $mId;
    private $mName;
    private $mIcon;
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
    
    public function setName($value) {
        $this->mName = $value;
    }

    public function getName() {
        return $this->mName;
    }
    
    public function setIcon($value) {
        $this->mIcon = $value;
    }
    
    public function getIcon() {
        return $this->mIcon;
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
            "name" => $this->mName,
            "icon" => $this->mIcon
        );
    }
}