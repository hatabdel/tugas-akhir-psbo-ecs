<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class StudentQuizDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_quiz';
    protected $primary_key = 'id';
    protected $fillable = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getStudentQuiz($Id) {
        return parent::getObject($Id);
    }
    
    public function InsertStudentQuiz($StudentQuizObj) {
		$result = parent::InsertObjectReturnId($StudentQuizObj);
        if (!is_null($result) && !is_null($StudentQuizObj)) { $StudentQuizObj->setStudentQuiz($result); }
		return $StudentQuizObj;
    }
    
    public function UpdateStudentQuiz($StudentQuizObj, $Id) {
        return parent::UpdateObject($StudentQuizObj, $Id);
    }
    
    public function DeleteStudentQuiz($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $StudentQuizObj = new StudentQuiz();
		
        $StudentQuizObj->setStudentQuiz($rowset["id"]);
        $StudentQuizObj->setIdentity($rowset["identity_id"]);
        $StudentQuizObj->setQuiz($rowset["quiz_id"]);
        $StudentQuizObj->setTotalScore($rowset["total_score"]);
        $StudentQuizObj->setStartDateTime($rowset["start_date_time"]);
        $StudentQuizObj->setEndDateTime($rowset["end_date_time"]);
        return $StudentQuizObj;
    }

}
