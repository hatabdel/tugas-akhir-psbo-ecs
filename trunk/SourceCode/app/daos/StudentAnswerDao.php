<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class StudentAnswerDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_answer';
    protected $primary_key = 'student_answer_id';
    protected $fillable = array('student_answer_id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getStudentAnswer($id) {
        return parent::getObject($id);
    }
    
    public function InsertStudentAnswer($StudentAnswerObj) {
		$result = parent::InsertObjectReturnId($StudentAnswerObj);
        if (!is_null($result) && !is_null($StudentAnswerObj)) { $StudentAnswerObj->setStudentAnswerId($result); }
		return $StudentAnswerObj;
    }
    
    public function UpdateStudentAnswer($StudentAnswerObj, $Id) {
        return parent::UpdateObject($StudentAnswerObj, $Id);
    }
    
    public function DeleteStudentAnswer($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $StudentAnswerObj = new StudentAnswer();
        
        $StudentAnswerObj->setStudentAnswerId($rowset["student_answer_id"]);
        $StudentAnswerObj->setStudentQuizId($rowset["student_quiz_id"]);
        $StudentAnswerObj->setQuizQuestionId($rowset["quiz_question_id"]);
        $StudentAnswerObj->setStudentAnswer($rowset["student_answer"]);
        $StudentAnswerObj->setScore($rowset["score"]);
        $StudentAnswerObj->setIsCorrect($rowset["is_correct"]);
        return $StudentAnswerObj;
    }

}
