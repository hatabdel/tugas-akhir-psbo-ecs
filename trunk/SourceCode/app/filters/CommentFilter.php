<?php
class CommentFilter
{
	private $mId;
	private $mTitle;
	private $mContent;
	private $mCreatedDate;
	private $mCreatedUser;
	private $mUpdatedDate;
	private $mUpdatedUser;
	private $mForumId;
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
	
	public function setIsLoaded($value)
	{
		$this->mIsLoaded = $value;
	}
	
	public function IsLoaded()
	{
		return $this->mIsLoaded;
	}
	
	public function getWhereQuery() {
       $where = "";
	   if(!is_null($this->mForumId) && !empty($this->mForumId))
	   {
			if(!empty($where)) { $where = " AND ";}
			$where .= " forum_id = '".stripslashes($this->mForumId)."'";
	   }
	   return $where;
    }
	
}