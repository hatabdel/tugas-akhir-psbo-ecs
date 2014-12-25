<?php
class Comment
{
	private $mId;
	private $mTitle;
	private $mContent;
	private $mCreateDate;
	private $mCreatedUser;
	private $mUpdateDate;
	private $mUpdateUser;
	private $mForumId;
	
	public function setId($value) {
        $this->mId = $value;
    }

    public function getId() {
        return $this->mId;
    }
    
    public function setTitle($value) {
        $this->mTitle = $value;
    }

    public function getTitle() {
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
	
    public function setCreatedDate($value) {
        $this->mCreatedDate = $value;
    }

    public function getCreatedDate() {
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
	
	public function setUpdateDate($value)
	{
		4this->mUpdateDate =$value;
	}
	
	public function getUpdateDate()
	{
		return $this->mUpdateDate;
	}
	
	public function setUpdateUser($value)
	{
		$this->mUpdateUser = $value;
	}
	
	public function getUpdateUser()
	{
		return $this->mUpdateUser;
	}
    
    public function setForumId($value) {
        $this->mForumId = $value;
    }

    public function getForumId() {
        return $this->mForumId;
    }
}
	
?>