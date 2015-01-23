<?php
class ForumFilter
{
	private $mCourseCode;
	private $mForumType;
    private $mIsActive;
	
	public function setCourseCode($value) {
        $this->mCourseCode = $value;
    }

    public function getCourseCode() {
        return $this->mCourseCode;
    }
    
    public function setForumType($value) {
        $this->mForumType = $value;
    }

    public function getForumType() {
        return $this->mForumType;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
	
	public function getWhereQuery() {
       $where = "";
	   if(!is_null($this->mCourseCode) && !empty($this->mCourseCode))
	   {
			if(!empty($where)) { $where = " AND ";}
			$where .= " course_code = '".stripslashes($this->mCourseCode)."'";
	   }
       
       if(!is_null($this->mForumType) && !empty($this->mForumType))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " forum_type = '".stripslashes($this->mForumType)."'";
	   }
       
       if(!is_null($this->mIsActive) && !empty($this->mIsActive))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " is_active = '".stripslashes($this->mIsActive)."'";
	   }
	   return $where;
    }
	
}