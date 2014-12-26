<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class PrivilegeInfoDao extends BaseDao implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'privilege_info';
    protected $primary_key = 'id';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getPrivilegeInfo($id) {
        return parent::getObject($id);
    }
    
    public function InsertPrivilegeInfo($PrivilegeInfoObj) {
        $result = parent::InsertObjectReturnId($PrivilegeInfoObj);
        if (!is_null($result) && !is_null($PrivilegeInfoObj)) { $PrivilegeInfoObj->setId($result); }
        return $PrivilegeInfoObj;
    }
    
    public function UpdatePrivilegeInfo($PrivilegeInfoObj, $Id) {
        return parent::UpdateObject($PrivilegeInfoObj, $Id);
    }
    
    public function DeletePrivilegeInfo($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $PrivilegeInfoObj = new PrivilegeInfo();
        $PrivilegeInfoObj->setId($rowset["id"]);
        $PrivilegeInfoObj->setFunctionId($rowset["function_id"]);
        $PrivilegeInfoObj->setUserGroupId($rowset["user_group_id"]);
        $PrivilegeInfoObj->setIsAllowRead($rowset["is_allow_read"]);
        $PrivilegeInfoObj->setIsAllowCreate($rowset["is_allow_create"]);
        $PrivilegeInfoObj->setIsAllowUpdate($rowset["is_allow_update"]);
        $PrivilegeInfoObj->setIsAllowDelete($rowset["is_allow_delete"]);
        return $PrivilegeInfoObj;
    }

}
