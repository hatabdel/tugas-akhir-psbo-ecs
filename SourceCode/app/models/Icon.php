<?php

class Icon {

    private $mId;
    private $mName;
    private $mIsLoaded;
    
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
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "name" => $this->mName
        );
    }
}