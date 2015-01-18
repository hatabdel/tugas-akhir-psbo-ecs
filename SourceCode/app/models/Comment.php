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
	private $mForum;
	private $mIsLoaded;
	
	public function __construct()
	{
		$this->mIsLoaded = false;
	}
	
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
		if (!is_null($this->mCreatedUser) && !empty($this->mCreatedUser)) {
            if (!$this->mCreatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mCreatedUser = $UserInfoDao->getUserInfo($this->mCreatedUser->getId());
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
	
	public function setUpdatedUser($value)
	{
		$this->mUpdatedUser = $value;
	}
	
	public function getUpdatedUser()
	{
		if (!is_null($this->mUpdatedUser) && !empty($this->mUpdatedUser)) {
            if (!$this->mUpdatedUser->IsLoaded()) {
                $UserInfoDao = new UserInfoDao();
                $this->mUpdatedUser = $UserInfoDao->getUserInfo($this->mUpdatedUser->getId());
                if (!is_null($this->mUpdatedUser)) { $this->mUpdatedUser->setIsLoaded(true); }
            }
        }
		return $this->mUpdatedUser;
	}
    
    public function setForum($value) {
        $this->mForum = $value;
    }

    public function getForum() {
		if (!is_null($this->mForum) && !empty($this->mForum)) {
            if (!$this->mForum->IsLoaded()) {
                $ForumDao = new ForumDao();
                $this->mForum = $ForumDao->getForum($this->mForum->getId());
                if (!is_null($this->mForum)) { $this->mForum->setIsLoaded(true); }
            }
        }
		
        return $this->mForum;
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
            "forum_id" => (!is_null($this->mForum) ? $this->mForum->getId() : null)
        );
    }
}