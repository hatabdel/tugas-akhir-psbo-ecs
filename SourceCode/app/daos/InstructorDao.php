<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class InstructorDao extends BaseDao implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'instructor';
	protected $primary_key = 'id';
    protected $fillable = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter=null) {
        return parent::getList($filter);
    }
    
    public function getInstructor($id) {
        return parent::getObject($id);
    }
    
    public function InsertInstructor($InstructorObj) {
        $result = parent::InsertObjectReturnId($InstructorObj);
        if (!is_null($result) && !is_null($InstructorObj)) { $InstructorObj->setId($result); }
        return $InstructorObj;
    }
    
    public function UpdateInstructor($InstructorObj, $Id) {
        return parent::UpdateObject($InstructorObj, $Id);
    }
    
    public function DeleteInstructor($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $InstructorObj = new Instructor();
        $InstructorObj->setId($rowset["id"]);
        
        $Course = new Course();
        $Course->setCode($rowset["course_code"]);
        $Course->setIsLoaded(false);
        $InstructorObj->setCourse($Course);
        
        $Instructor = new UserInfo();
        $Instructor->setUserName($rowset['user_name']);
        $Instructor->setIsLoaded(false);
        $InstructorObj->setUserInfo($Instructor);
        
        $CreatedUser = new UserInfo();
        $CreatedUser->setUserName($rowset['created_user']);
        $CreatedUser->setIsLoaded(false);
        $InstructorObj->setCreatedUser($CreatedUser);
        
		$InstructorObj->setCreatedDate($rowset["created_date"]);
        return $InstructorObj;
    }
}
?>