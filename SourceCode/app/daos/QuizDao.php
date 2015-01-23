<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class QuizDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz';
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
    
    public function getQuiz($id) {
        return parent::getObject($id);
    }
	
     public function InsertQuiz($QuizObj) {
		try {
		$result = parent::InsertObjectReturnId($QuizObj);
        if (!is_null($result) && !is_null($QuizObj)) { $QuizObj->setId($result); }
		return $QuizObj;
		} catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
  
    public function UpdateQuiz($QuizObj, $Id) {
        return parent::UpdateObject($QuizObj, $Id);
    }
    
    public function DeleteQuiz($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $QuizObj = new Quiz();
        $QuizObj->setId($rowset["id"]);
        $QuizObj->setQuizName($rowset["quiz_name"]);
        $CourseObj = new Course();
        $CourseObj->setCode($rowset["course_code"]);
        $CourseObj->setIsLoaded(true);
        $QuizObj->setCourse($CourseObj);
        $QuizTypeObj = new QuizType();
        $QuizTypeObj->setId($rowset["quiz_type_id"]);
        $QuizTypeObj->setIsLoaded(true);
        $QuizObj->setQuizType($QuizTypeObj);
        $QuizObj->setStartDateTime($rowset["start_date_time"]);
        $QuizObj->setEndDateTime($rowset["end_date_time"]);
        $QuizObj->setQuizTime($rowset["quiz_time"]);
        return $QuizObj;
    }

}
