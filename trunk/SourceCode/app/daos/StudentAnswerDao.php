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
    
    public function getStudentAnswer($id) {
        return parent::getObject($id);
    }
    
    public function InsertStudentAnswer($StudentAnswerObj) {
		$result = parent::InsertObjectReturnId($StudentAnswerObj);
        if (!is_null($result) && !is_null($StudentAnswerObj)) { $StudentAnswerObj->setId($result); }
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
        
        $StudentAnswerObj->setId($rowset["id"]);
        $StudentQuizObj = new StudentQuiz();
        $StudentQuizObj->setId($rowset["student_quiz_id"]);
        $StudentQuizObj->setIsLoaded(false);
        $StudentAnswerObj->setStudentQuiz($StudentQuizObj);
        $QuizQuestionObj = new QuizQuestion();
        $QuizQuestionObj->setId($rowset["quiz_question_id"]);
        $QuizQuestionObj->setIsLoaded(false);
        $StudentAnswerObj->setQuizQuestion($QuizQuestionObj);
        $AnswerObj = new Answer();
        $AnswerObj->setId($rowset["answer_id"]);
        $AnswerObj->setIsLoaded(false);
        $StudentAnswerObj->setAnswer($AnswerObj);
        $StudentAnswerObj->setScore($rowset["score"]);
        $StudentAnswerObj->setIsCorrect($rowset["is_correct"]);
        return $StudentAnswerObj;
    }

}
