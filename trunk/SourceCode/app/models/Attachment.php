<?php

class Attachment {

    private $mId;
    private $mFunctionId;
    private $mRecordId;
    private $mFileName;
    private $mFileType;
    private $mFileExtention;
    private $mFilePath;
    private $mDescription;
    private $mCreateDate;
    private $mCreateUser;
    
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
    
    public function setRecordId($value) {
        $this->mRecordId = $value;
    }
    
    public function getRecordId()
    {
    	return $this->mRecordId;
    }
    
    public function setFileName($value)
    {	
    	$this->mFileName = $value;
    }

    public function getFileName() {
        return $this->mFileName;
    }
    
    public function setFileType($value) {
        $this->mFileType = $value;
    }

    public function getFileType() {
        return $this->mFileType;
    }
    
     public function setFileExtention($value) {
        $this->mFileExtention = $value;
    }

    public function getFileExtention() {
        return $this->mFileExtention;
    }
    
    public function setFilePath($value) {
        $this->mFilePath = $value;
    }

    public function getFilePath() {
        return $this->mFilePath;
    }
    
    public function setDescription($value) {
        $this->mDescription = $value;
    }

    public function getDescription() {
        return $this->mDescription;
    }
    
    public function setCreateDate($value) {
        $this->mCreateDate = $value;
    }

    public function getCreateDate() {
        return $this->mCreateDate;
    }
    
    public function setCreateUser($value) {
        $this->mCreateUser = $value;
    }

    public function getCreateUser() {
        return $this->mCreateUser;
    }
}
