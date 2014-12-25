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
	protected $table = 'user_info';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getCourseDetail($id) {
        return parent::getObject($id);
    }
    
    public function InsertCourseDetail($CourseDetailObj) {
        return parent::InsertObject($CourseDetailObj);
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
        $CourseDetailObj->setIdentityId($rowset["identity_id"]);
        $CourseDetailObj->setCourseCode($rowset["course_code"]);
        $CourseDetailObj->setCreatedDate($rowset["created_date"]);
        return $CourseDetailObj;
    }

}
