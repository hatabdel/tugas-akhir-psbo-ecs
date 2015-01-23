<?php
class InstructorService extends BaseService
{
	private $InstructorDao;
    
    public function __construct() {
        parent::__construct();
        $this->InstructorDao = new InstructorDao();
    }
	public function getList() {
        try {
            return $this->InstructorDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getInstructor($id) {
        try { 
            return $this->InstructorDao->getInstructor($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function InsertInstructor($InstructorObj) {
        try {
            if (!$this->validateOnInsert($InstructorObj)) { return false; }
			$InstructorObj->setCreatedDate(Date("Y-m-d H:i:s"));
			$InstructorObj->setCreatedUser($this->mUserInfo);
            return $this->InstructorDao->InsertInstructor($InstructorObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateInstructor($InstructorObj, $Id) {
        try {
            if (!$this->validateOnUpdate($InstructorObj)) { return false; }
			$InstructorObjOld = $this->getInstructor($Id);
			if (!is_null($InstructorObjOld)) {
				$InstructorObj->setCreatedDate($InstructorObjOld->getCreatedDate());
				$InstructorObj->setCreatedUser($InstructorObjOld->getCreatedUser());
			}
			$InstructorObj->setUpdatedDate(Date("Y-m-d H:i:s"));
            return $this->InstructorDao->UpdateInstructor($InstructorObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteInstructor($Id) {
        try {
            return $this->InstructorDao->DeleteInstructor($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
	
	private function validateBase($model) {
        if (is_null($model)) { return false; }
        
        return $this->getServiceState();
    }
    
    private function validateOnInsert($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
		
        return $this->getServiceState();
    }
    
    private function validateOnUpdate($model) {
        if (is_null($model)) { return false; }
        $this->validateBase($model);
        return $this->getServiceState();
    }
}
?>