<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AttendanceDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attendance';
    protected $primary_key = 'id';
    protected $fillable = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getAttendance($id) {
        return parent::getObject($id);
    }
    
    public function InsertAttendance($AttendanceObj) {
        try {
            return parent::InsertObject($AttendanceObj);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateAttendance($AttendanceObj, $Id) {
        try {
            return parent::UpdateObject($AttendanceObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteAttendance($Id) {
        try {
            return parent::DeleteObject($Id);
        } catch (Exception $ex) {
            $this->addError($ex-getMessages());
            throw new Exception($ex->getMessage());
        }
    }
    
    function toObject($rowset) {
        $AttendanceObj = new Attendance();
        $AttendanceObj->setId($rowset["id"]);
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($rowset["user_name"]);
        $UserInfoObj->setIsLoaded(false);
        $AttendanceObj->setUserInfo($UserInfoObj);
        $WebinarObj = new Webinar();
        $WebinarObj->setId($rowset["webinar_id"]);
        $WebinarObj->setIsLoaded(false);
        $AttendanceObj->setWebinar($WebinarObj);
        $AttendanceObj->setCreatedDate($rowset["created_date"]);
        $AttendanceObj->setIsLoaded(true);
        return $AttendanceObj;
    }

}
