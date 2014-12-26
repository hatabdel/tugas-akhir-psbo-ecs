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
        return $this->mFunctionId;
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
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "function_id" => $this->mFunctionId,
            "user_group_id" => $this->mUserGroupId,
            "is_allow_read" => +$this->mIsAllowRead,
            "is_allow_create" => +$this->mIsAllowCreate,
            "is_allow_update" => +$this->mIsAllowUpdate,
            "is_allow_delete" => +$this->mIsAllowDelete
        );
    }
}