<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserGroupDao extends BaseDao implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_group';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getUserGroup($id) {
        return parent::getObject($id);
    }
    
    public function InsertUserGroup($UserGroupObj) {
        return parent::InsertObject($UserGroupObj);
    }
    
    public function UpdateUserGroup($UserGroupObj, $Id) {
        return parent::UpdateObject($UserGroupObj, $Id);
    }
    
    public function DeleteUserGroup($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $UserGroupObj = new UserGroup();
        $UserGroupObj->setUserName($rowset["user_name"]);
        $UserGroupObj->setPassword($rowset["password"]);
        $UserGroupObj->setCreatedDate($rowset["created_date"]);
        $UserGroupObj->setIsActive($rowset["is_active"]);
        return $UserGroupObj;
    }

}
