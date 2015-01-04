<?php
class Comment
{
	private $mId;
	private $mTitle;
	private $mContent;
	private $mCreatedDate;
	private $mCreatedUser;
	private $mUpdatedDate;
	private $mUpdatedUser;
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
		if (!is_null($this->mCreatedUser) && !empty($this->mCreatedUser)) {
            if (!$this->mCreatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUser->getId());
                if (!is_null($this->mCreatedUser)) { $this->mCreatedUser->setIsLoaded(true); }
            }
        }
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
	
	public function setUpdatedUser($value)
	{
		$this->mUpdatedUser = $value;
	}
	
	public function getUpdatedUser()
	{
		return $this->mUpdatedUser;
	}
    
    public function setForumId($value) {
        $this->mForumId = $value;
    }

    public function getForumId() {
		if (!is_null($this->mForumId) && !empty($this->mForumId)) {
            if (!$this->mForumId->IsLoaded()) {
                $ForumDao = new ForumDao();
                $this->mForumId = $ForumDao->getForum($this->mForumId->getId());
                if (!is_null($this->mForumId)) { $this->mForumId->setIsLoaded(true); }
            }
        }
        return $this->mForumId;
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
            "forum_id" => (!is_null($this->mForumId) ? $this->mForumId->getId() : null)
        );
    }
}