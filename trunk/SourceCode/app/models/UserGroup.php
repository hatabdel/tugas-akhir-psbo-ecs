<?php

class UserGroup {

    private $mId;
    private $mName;
    private $mIsLoaded;
    private $mPrivilegesInfos;
    
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
    
    public function setPrivilegeInfos($value) {
        $this->mPrivilegesInfos = $value;
    }
    
    public function getPrivilegeInfos() {
        if (!is_null($this->mId) && is_null($this->mPrivilegesInfos)) {
            $PrivilegeInfoFilter = new PrivilegeInfoFilter();
            $PrivilegeInfoFilter->setUserGroupId($this->mId);
            $PrivilegeInfoDao = new PrivilegeInfoDao();
            $this->mPrivilegesInfos = $PrivilegeInfoDao->getList($PrivilegeInfoFilter);
        }
        return $this->mPrivilegesInfos;
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