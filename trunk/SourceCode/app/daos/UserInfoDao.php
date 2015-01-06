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
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getUserInfo($id) {
        return parent::getObject($id);
    }
    
    public function InsertUserInfo($UserInfoObj) {
        try {
            return parent::InsertObject($UserInfoObj);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateUserInfo($UserInfoObj, $Id) {
        try {
            return parent::UpdateObject($UserInfoObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteUserInfo($Id) {
        try {
            return parent::DeleteObject($Id);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    function toObject($rowset) {
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($rowset["user_name"]);
        $UserInfoObj->setPassword($rowset["password"]);
        $UserInfoObj->setCreatedDate($rowset["created_date"]);
        $UserInfoObj->setUpdatedDate($rowset["updated_date"]);
        $UserGroupObj = new UserGroup();
        $UserGroupObj->setId($rowset["user_group_id"]);
        $UserGroupObj->setIsLoaded(false);
        $UserInfoObj->setUserGroup($UserGroupObj);
        $UserInfoObj->setIsActive($rowset["is_active"]);
        $UserInfoObj->setIsLoaded(true);
        return $UserInfoObj;
    }

}
