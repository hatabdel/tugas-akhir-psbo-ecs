<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class WebinarDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'webinar';
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
    
    public function getWebinar($id) {
        return parent::getObject($id);
    }
    
    public function InsertWebinar($WebinarObj) {
        try {
            $result = parent::InsertObjectReturnId($WebinarObj);
            if (!is_null($result) && !is_null($WebinarObj)) { $WebinarObj->setId($result); }
            return $WebinarObj;
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function UpdateWebinar($WebinarObj, $Id) {
        try {
            return parent::UpdateObject($WebinarObj, $Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function DeleteWebinar($Id) {
        try {
            return parent::DeleteObject($Id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    function toObject($rowset) {
        $WebinarObj = new Webinar();
        $WebinarObj->setId($rowset["id"]);
        $WebinarObj->setTitle($rowset["title"]);
        $CourseObj = new Course();
        $CourseObj->setCode($rowset["course_code"]);
        $CourseObj->setIsLoaded(false);
        $WebinarObj->setCourse($CourseObj);
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($rowset["created_user"]);
        $UserInfoObj->setIsLoaded(false);
        $WebinarObj->setCreatedUser($UserInfoObj);
        $WebinarObj->setCreatedDate($rowset["created_date"]);
        $WebinarObj->setStartDate($rowset["start_date"]);
        $WebinarObj->setEndDate($rowset["end_date"]);
        $WebinarObj->setIsLoaded(true);
        return $WebinarObj;
    }

}
