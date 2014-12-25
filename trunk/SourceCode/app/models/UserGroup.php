<?php

class UserGroup {

    private $mId;
    private $mName;
    private $mListPrivilageInfo;
    
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
    
    public function setListPrivilageInfo($value) {
        $this->mListPrivilageInfo = $value;
    }

    public function getListPrivilageInfo() {
        return $this->mListPrivilageInfo;
    }
}
?>