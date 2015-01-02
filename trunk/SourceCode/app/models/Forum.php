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
            "created_user" => $this->mCreatedUser,
            "update_date" => $this->mUpdatedDate,
            "update_user" => $this->mUpdatedUser,
            "course_code" => $this->mCourseCode,
            "is_public" => $this->mIsPublic
        );
    }
	
}
?>