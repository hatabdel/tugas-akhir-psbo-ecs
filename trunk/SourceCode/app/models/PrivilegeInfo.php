<?php

class PrivilegeInfo {

    private $mId;
    private $mFunctionId;
    private $mUserGroupId;
    private $mIsAllowRead;
	private $mIsAllowCreate;
	private $mIsAllowUpdate;
	private $mIsAllowDelete;
    
    public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setFunctionId($value) {
        $this->mFunctionId = $value;
    }

    public function getFunctionId() {
        //return $this->mPassword;
    }
    
    public function setUserGroupId($value) {
        $this->mUserGroupId = $value;
    }

    public function getUserGroupId() {
        return $this->mUserGroupId;
    }
    
    public function setIsAllowRead($value) {
        $this->mIsAllowRead = $value;
    }

    public function IsAllowRead() {
        return $this->mIsAllowRead;
    }
	
	public function setIsAllowCreate($value) {
        $this->mIsAllowCreate = $value;
    }

    public function IsAllowCreate() {
        return $this->mIsAllowCreate;
    }
	
	public function setIsAllowUpdate($value) {
        $this->mIsAllowUpdate = $value;
    }

    public function IsAllowUpdate() {
        return $this->mIsAllowUpdate;
    }
	
	public function setIsAllowDelete($value) {
        $this->mIsAllowDelete = $value;
    }

    public function IsAllowDelete() {
        return $this->mIsAllowDelete;
    }
}
?>