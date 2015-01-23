<?php

class Instructor {
    private $mId;
    private $mCourse;
    private $mUserInfo;
    private $mCreatedDate;
    private $mCreatedUser;
    private $mIsLoaded;
    
    public function __construct()
	{
		$this->mIsLoaded = false;
	}
	
	public function setId($value)
	{
		$this->mId = $value;
	}
	
	public function getId()
	{
		return $this->mId;
	}
    
    public function setCourse($value)
	{
		$this->mCourse = $value;
	}
	
	public function getCourse()
	{
		if (!is_null($this->mCourse) && !empty($this->mCourse)) {
            if (!$this->mCourse->IsLoaded()) {
                $CourseDao = new CourseDao();
                $this->mCourse = $CourseDao->getCourse($this->mCourse->getCode());
                if (!is_null($this->mCourse)) { $this->mCourse->setIsLoaded(true); }
            }
        }
		return $this->mCourse;
	}
    
    public function setUserInfo($value)
	{
		$this->mUserInfo = $value;
	}
	
	public function getUserInfo()
	{
		if (!is_null($this->mUserInfo) && !empty($this->mUserInfo)) {
            if (!$this->mUserInfo->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUserInfo = $UserInfoDao->getUserInfo($this->mUserInfo->getUserName());
                if (!is_null($this->mUserInfo)) { $this->mUserInfo->setIsLoaded(true); }
            }
        }
		return $this->mUserInfo;
	}
    
    public function setCreatedDate($value)
	{
		$this->mCreatedDate = $value;
	}
	
	public function getCreatedDate()
	{
		return $this->mCreatedDate;
	}
    
    public function setCreatedUser($value)
	{
		$this->mCreatedUser = $value;
	}
	
	public function getCreatedUser()
	{
		if (!is_null($this->mCreatedUser) && !empty($this->mCreatedUser)) {
            if (!$this->mCreatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUser->getUserName());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
		return $this->mCreatedUser;
	}
    
    public function setIsLoaded($value)
	{
		$this->mIsLoaded = $value;
	}
	
	public function IsLoaded()
	{
		return $this->mIsLoaded;
	}
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "user_name" => (!is_null($this->mUserInfo) ? $this->mUserInfo->getUserName() : null),
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "course_code" => (!is_null($this->mCourse) ? $this->mCourse->getCode() : null)
        );
    }
}

