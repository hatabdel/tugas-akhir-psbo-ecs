<?php
class Forum
{
	private $mId;
	private $mTitle;
	private $mContent;
	private $mCreatedDate;
	private $mCreatedUser;
	private $mUpdatedDate;
	private $mUpdatedUser;
	private $mCourse;
	private $mListOfComments;
	private $mIsPublic;
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
	
	public function setTitle($value)
	{
		$this->mTitle = $value;
	}
	
	public function getTitle()
	{
		return $this->mTitle;
	}
	
	public function setContent($value)
	{
		$this->mContent = $value;
	}
	
	public function getContent()
	{
		return $this->mContent;
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
	
	public function setUpdatedDate($value)
	{
		$this->mUpdatedDate = $value;
	}
	
	public function getUpdatedDate()
	{
		return $this->mUpdatedDate;
	}
	
	public function setUpdatedUser()
	{
		$this->mUpdatedUser = $value;
	}
	
	public function getUpdatedUser()
	{
		if (!is_null($this->mUpdatedUser) && !empty($this->mUpdatedUser)) {
            if (!$this->mUpdatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUpdatedUser = $UserInfoDao->getUserInfo($this->mUpdatedUser->getUserName());
                if (!is_null($this->mUpdatedUser)) { $this->mUpdatedUser->setIsLoaded(true); }
            }
        }
		return $this->mUpdateduser;
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
	
	public function setListOfComments($value)
	{
		$this->mListOfComments = $value;
	}
	
	public function getListOfComments()
	{
		//return $this->mListOfCourse;
	}
	
	public function setIsPublic($value)
	{
		$this->mIsPublic = $value;
	}
	
	public function IsPublic()
	{
		return $this->mIsPublic;
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
            "title" => $this->mTitle,
            "content" => $this->mContent,
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "update_date" => $this->mUpdatedDate,
            "update_user" => $this->mUpdatedUser,
            "course_code" => (!is_null($this->mCourse) ? $this->mCourse->getCode() : null),
            "is_public" => $this->mIsPublic
        );
    }
	
}
?>