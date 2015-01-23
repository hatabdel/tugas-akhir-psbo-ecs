<?php
class QuizFilter
{
	private $mCourseCode;
	private $mRecordId;
    private $mIsActive;
	
	public function setCourseCode($value) {
        $this->mCourseCode = $value;
    }

    public function getCourseCode() {
        return $this->mCourseCode;
    }
    
    public function setRecordId($value) {
        $this->mRecordId = $value;
    }

    public function getRecordId() {
        return $this->mRecordId;
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
       
       if(!is_null($this->mRecordId) && !empty($this->mRecordId))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " record_id = '".stripslashes($this->mRecordId)."'";
	   }
       
       if(!is_null($this->mIsActive) && !empty($this->mIsActive))
	   {
			if(!empty($where)) { $where .= " AND ";}
			$where .= " is_active = '".stripslashes($this->mIsActive)."'";
	   }
	   return $where;
    }
	
}