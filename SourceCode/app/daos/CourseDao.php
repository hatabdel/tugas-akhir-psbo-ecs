<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CourseDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'course';
    protected $primary_key = 'code';
    protected $fillable = array('code');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getCourse($id) {
        return parent::getObject($id);
    }
    
    public function InsertCourse($CourseObj) {
        return parent::InsertObject($CourseObj);
    }
    
    public function UpdateCourse($CourseObj, $Id) {
        return parent::UpdateObject($CourseObj, $Id);
    }
    
    public function DeleteCourse($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $CourseObj = new Course();
        $CourseObj->setCode($rowset["code"]);
        $CourseObj->setName($rowset["name"]);
        $CourseObj->setDescription($rowset["description"]);
        $CourseObj->setStartDate($rowset["start_date"]);
        $CourseObj->setEndDate($rowset["end_date"]);
        $CourseObj->setCreatedDate($rowset["created_date"]);
        $CreatedUser = new UserInfo();
        $CreatedUser->setUserName($rowset["created_user"]);
        $CreatedUser->setIsLoaded(true);
        $CourseObj->setCreatedUser($CreatedUser);
        $CourseObj->setIsActive($rowset["is_active"]);
        return $CourseObj;
    }

}
