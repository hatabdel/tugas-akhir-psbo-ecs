<?php

class PrivilegeInfo {

    private $mId;
    private $mFunctionInfo;
    private $mUserGroup;
    private $mIsAllowRead;
	private $mIsAllowCreate;
	private $mIsAllowUpdate;
	private $mIsAllowDelete;
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
    
    public function setFunctionInfo($value) {
        $this->mFunctionInfo = $value;
    }

    public function getFunctionInfo() {
        if (!is_null($this->mFunctionInfo) && !empty($this->mFunctionInfo)) {
            if (!$this->mFunctionInfo->IsLoaded()) {
                $FunctionInfoDao = new FunctionInfoDao();
                $this->mFunctionInfo = $FunctionInfoDao->getFunctionInfo($this->mFunctionInfo->getFunctionId());
                if (!is_null($this->mFunctionInfo)) { $this->mFunctionInfo->setIsLoaded(true); }
            }
        }
        return $this->mFunctionInfo;
    }
    
    public function setUserGroup($value) {
        $this->mUserGroup = $value;
    }

    public function getUserGroup() {
        if (!is_null($this->mUserGroup) && !empty($this->mUserGroup)) {
            if (!$this->mUserGroup->IsLoaded()) {
                $UserGroupDao = new UserGroupDao();
                $this->mUserGroup = $UserGroupDao->getUserGroup($this->mUserGroup->getId());
                if (!is_null($this->mUserGroup)) { $this->mUserGroup->setIsLoaded(true); }
            }
        }
        return $this->mUserGroup;
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
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }

        public function toArray() {
        return array(
            "id" => $this->mId,
            "function_id" => (!is_null($this->mFunctionInfo) ? $this->mFunctionInfo->getFunctionId() : null),
            "user_group_id" => (!is_null($this->mUserGroup) ? $this->mUserGroup->getId() : null),
            "is_allow_read" => +$this->mIsAllowRead,
            "is_allow_create" => +$this->mIsAllowCreate,
            "is_allow_update" => +$this->mIsAllowUpdate,
            "is_allow_delete" => +$this->mIsAllowDelete
        );
    }
}