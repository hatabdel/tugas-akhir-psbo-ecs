<?php
class AttachmentFilter
{
	private $mFunctionId;
	private $mRecordId;
    private $mIsActive;
	
	public function setFunctionId($value) {
        $this->mFunctionId = $value;
    }

    public function getFunctionId() {
        return $this->mFunctionId;
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
	   if(!is_null($this->mFunctionId) && !empty($this->mFunctionId))
	   {
			if(!empty($where)) { $where = " AND ";}
			$where .= " function_id = '".stripslashes($this->mFunctionId)."'";
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