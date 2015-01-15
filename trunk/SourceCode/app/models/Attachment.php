<?php

class Attachment {

    private $mId;
    private $mFunctionId;
    private $mRecordId;
    private $mFileName;
    private $mOriginalFileName;
    private $mFileType;
    private $mFileExtention;
    private $mFilePath;
    private $mDescription;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mIsLoaded;
    
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
    
    public function setOriginalFileName($value)
    {	
    	$this->mOriginalFileName = $value;
    }

    public function getOriginalFileName() {
        return $this->mOriginalFileName;
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
    
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }

    public function getCreatedDate() {
        return $this->mCreatedDate;
    }
    
    public function setCreatedUser($value) {
        $this->mCreatedUser = $value;
    }

    public function getCreatedUser() {
        if (!is_null($this->mCreatedUser) && !empty($this->mCreatedUser)) {
            if (!$this->mCreatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUser->getUserName());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
		return $this->mCreatedUser;
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
            "function_id" => $this->mFunctionId,
            "record_id" => $this->mRecordId,
            "file_name" => $this->mFileName,
            "original_file_name" => $this->mOriginalFileName,
            "file_type" => $this->mFileType,
            "file_extention" => $this->mFileExtention,
            "file_path" => $this->mFilePath,
            "description" => $this->mDescription,
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null)
        );
    }
}
