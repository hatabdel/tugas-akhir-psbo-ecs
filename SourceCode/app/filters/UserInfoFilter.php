<?php
class UserInfoFilter
{
	private $mUserName;
	private $mPassword;
	
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
	   return $where;
    }
	
}