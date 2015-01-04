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
	private $mCourseCode;
	private $mListOfComments;
	private $mIsPublic;
	
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
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUse->getUserName());
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
		return $this->mUpdateuser;
	}
	
	public function setCourseCode($value)
	{
		$this->mCourseCode = $value;
	}
	
	public function getCourseCode()
	{
		if (!is_null($this->mCourseCode) && !empty($this->mCourseCode)) {
            if (!$this->mCourseCode->IsLoaded()) {
                $CourseDao = new CourseDao();
                $this->mCourseCode = $CourseDao->getCourse($this->mCourseCode->getCode());
                if (!is_null($this->mCourseCode)) { $this->mCourseCode->setIsLoaded(true); }
            }
        }
		return $this->mCourseCode;
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
        
    public function toArray() {
        return array(
            "id" => $this->mId,
            "title" => $this->mTitle,
            "content" => $this->mContent,
            "created_date" => $this->mCreatedDate,
            "created_user" => (!is_null($this->mCreatedUser) ? $this->mCreatedUser->getUserName() : null),
            "update_date" => $this->mUpdatedDate,
            "update_user" => $this->mUpdatedUser,
            "course_code" => (!is_null($this->mCourseCode) ? $this->mCourseCode->getCode() : null),
            "is_public" => $this->mIsPublic
        );
    }
	
}
?>