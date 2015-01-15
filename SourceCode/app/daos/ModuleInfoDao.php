<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ModuleInfoDao extends BaseDao implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'module_info';
    protected $primary_key = 'id';
    protected $fillable = array('name');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getModuleInfo($id) {
        return parent::getObject($id);
    }
    
    public function InsertModuleInfo($ModuleInfoObj) {
        $result = parent::InsertObjectReturnId($ModuleInfoObj);
        if (!is_null($result) && !is_null($ModuleInfoObj)) { $ModuleInfoObj->setId($result); }
        return $ModuleInfoObj;
    }
    
    public function UpdateModuleInfo($ModuleInfoObj, $Id) {
        return parent::UpdateObject($ModuleInfoObj, $Id);
    }
    
    public function DeleteModuleInfo($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $ModuleInfoObj = new ModuleInfo();
        $ModuleInfoObj->setId($rowset["id"]);
        $ModuleInfoObj->setName($rowset["name"]);
        $ModuleInfoObj->setIcon($rowset["icon"]);
        return $ModuleInfoObj;
    }

}
