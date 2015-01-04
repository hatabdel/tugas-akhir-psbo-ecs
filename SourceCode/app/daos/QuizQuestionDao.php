<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class QuizQuestionDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz_question';
    protected $primary_key = 'quiz_question_id';
    protected $fillable = array('quiz_question_id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getQuizQuestion($id) {
        return parent::getObject($id);
    }
    
    public function InsertQuizQuestion($QuizQuestionObj) {
		$result = parent::InsertObjectReturnId($QuizQuestionObj);
        if (!is_null($result) && !is_null($QuizQuestionObj)) { $QuizQuestionObj->setQuizQuestionId($result); }
		return $QuizQuestionObj;
    }
    
    public function UpdateQuizQuestion($QuizQuestionObj, $Id) {
        return parent::UpdateObject($QuizQuestionObj, $Id);
    }
    
    public function DeleteQuizQuestion($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $QuizQuestionObj = new QuizQuestion();
        
        $QuizQuestionObj->setQuizQuestionId($rowset["quiz_question_id"]);
        $QuizQuestionObj->setQuizId($rowset["quiz_id"]);
        $QuizQuestionObj->setQuestion($rowset["question"]);
        $QuizQuestionObj->setAnswerTypeId($rowset["answer_type_id"]);
        $QuizQuestionObj->setScore($rowset["score"]);
        return $QuizQuestionObj;
    }

}
