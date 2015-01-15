<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class FunctionInfoDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'function_info';
    protected $primary_key = 'function_id';
    protected $fillable = array('function_id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getFunctionInfo($id) {
        return parent::getObject($id);
    }
    
    public function InsertFunctionInfo($FunctionInfoObj) {
        try {
            return parent::InsertObject($FunctionInfoObj);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateFunctionInfo($FunctionInfoObj, $Id) {
        return parent::UpdateObject($FunctionInfoObj, $Id);
    }
    
    public function DeleteFunctionInfo($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $FunctionInfoObj = new FunctionInfo();
        
        $FunctionInfoObj->setFunctionId($rowset["function_id"]);
        $FunctionInfoObj->setName($rowset["name"]);
        $FunctionInfoObj->setRoute($rowset["route"]);
        $ModuleInfo = new ModuleInfo();
        $ModuleInfo->setId($rowset["module_info_id"]);
        $ModuleInfo->setIsLoaded(false);
        $FunctionInfoObj->setModuleInfo($ModuleInfo);
        $FunctionInfoObj->setIcon($rowset["icon"]);
        $FunctionInfoObj->setUrl($rowset["url"]);
        $FunctionInfoObj->setIsActive($rowset["is_active"]);
        $FunctionInfoObj->setIsShow($rowset["is_show"]);
        return $FunctionInfoObj;
    }

}
