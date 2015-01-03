<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class UserInfoDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_info';
    protected $primary_key = 'user_name';
    protected $fillable = array('user_name');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getUserInfo($id) {
        return parent::getObject($id);
    }
    
    public function InsertUserInfo($UserInfoObj) {
        return parent::InsertObject($UserInfoObj);
    }
    
    public function UpdateUserInfo($UserInfoObj, $Id) {
        return parent::UpdateObject($UserInfoObj, $Id);
    }
    
    public function DeleteUserInfo($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($rowset["user_name"]);
        $UserInfoObj->setPassword($rowset["password"]);
        $UserInfoObj->setCreatedDate($rowset["created_date"]);
        $UserInfoObj->setIsActive($rowset["is_active"]);
        return $UserInfoObj;
    }

}
