<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CourseDetailDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'course_detail';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getCourseDetail($id) {
        return parent::getObject($id);
    }
    
    public function InsertCourseDetail($CourseDetailObj) {
        $result = parent::InsertObjectReturnId($CourseDetailObj);
        if (!is_null($result) && !is_null($CourseDetailObj)) { $CourseDetailObj->setId($result); }
        return $CourseDetailObj;
    }
    
    public function UpdateCourseDetail($CourseDetailObj, $Id) {
        return parent::UpdateObject($CourseDetailObj, $Id);
    }
    
    public function DeleteCourseDetail($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $CourseDetailObj = new CourseDetail();
        $CourseDetailObj->setId($rowset["id"]);
        $UserInfo = new UserInfo();
        $UserInfo->setUserName($rowset["user_name"]);
        $UserInfo->setIsLoaded(false);
        $CourseDetailObj->setUserInfo($UserInfo);
        $Course = new Course();
        $Course->setCode($rowset["course_code"]);
        $Course->setIsLoaded(false);
        $CourseDetailObj->setCourse($Course);
        $CourseDetailObj->setJoinDate($rowset["join_date"]);
        return $CourseDetailObj;
    }

}
