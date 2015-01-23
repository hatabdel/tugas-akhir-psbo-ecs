<?php
class CourseDetailFilter
{
	private $mUserName;
	private $mPassword;
    private $mIsActive;
	
	public function setUserName($value) {
        $this->mUserName = $value;
    }

    public function getUserName() {
        return $this->mUserName;
    }
    
    public function setPassword($value) {
        $this->mPassword = $value;
    }

    public function getPassword() {
        return $this->mPassword;
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
       
       if(!is_null($this->mPassword) && !empty($this->mPassword))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " password = '".stripslashes($this->mPassword)."'";
	   }
       
       if(!is_null($this->mIsActive) && !empty($this->mIsActive))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " is_active = '".stripslashes($this->mIsActive)."'";
	   }
	   return $where;
    }
	
}