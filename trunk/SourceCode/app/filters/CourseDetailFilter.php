<?php
class CourseDetailFilter
{
	private $mUserName;
	private $mCourseCode;
    private $mIsActive;
	
	public function setUserName($value) {
        $this->mUserName = $value;
    }

    public function getUserName() {
        return $this->mUserName;
    }
    
    public function setCourseCode($value) {
        $this->mCourseCode = $value;
    }

    public function getCourseCode() {
        return $this->mCourseCode;
    }
    
    public function setIsActive($value) {
        $this->mIsActive = $value;
    }

    public function IsActive() {
        return $this->mIsActive;
    }
	
	public function getWhereQuery() {
       $where = "";
	   if(!is_null($this->mUserName) && !empty($this->mUserName))
	   {
			if(!empty($where)) { $where = " AND ";}
			$where .= " user_name = '".stripslashes($this->mUserName)."'";
	   }
       
       if(!is_null($this->mCourseCode) && !empty($this->mCourseCode))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " course_code = '".stripslashes($this->mCourseCode)."'";
	   }
       
       if(!is_null($this->mIsActive) && !empty($this->mIsActive))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " is_active = '".stripslashes($this->mIsActive)."'";
	   }
	   return $where;
    }
	
}