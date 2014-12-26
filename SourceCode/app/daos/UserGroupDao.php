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
    protected $primary_key = 'id';
    protected $fillable = array('name');
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
        $result = parent::InsertObjectReturnId($UserGroupObj);
        if (!is_null($result) && !is_null($UserGroupObj)) { $UserGroupObj->setId($result); }
        return $UserGroupObj;
    }
    
    public function UpdateUserGroup($UserGroupObj, $Id) {
        return parent::UpdateObject($UserGroupObj, $Id);
    }
    
    public function DeleteUserGroup($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $UserGroupObj = new UserGroup();
        $UserGroupObj->setId($rowset["id"]);
        $UserGroupObj->setName($rowset["name"]);
        return $UserGroupObj;
    }

}
