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
    protected $primary_key = 'id';
    protected $fillable = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
    
    public function __construct() {
        parent::__construct();
    }
    
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getQuizQuestion($id) {
        return parent::getObject($id);
    }
    
    public function InsertQuizQuestion($QuizQuestionObj) {
		$result = parent::InsertObjectReturnId($QuizQuestionObj);
        if (!is_null($result) && !is_null($QuizQuestionObj)) { $QuizQuestionObj->setId($result); }
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
        $QuizQuestionObj->setId($rowset["id"]);
        $QuizObj = new Quiz();
        $QuizObj->setId($rowset["quiz_id"]);
        $QuizObj->setIsLoaded(false);
        $QuizQuestionObj->setQuiz($QuizObj);
        $QuizQuestionObj->setQuestion($rowset["question"]);
        $QuizQuestionObj->setScore($rowset["score"]);
        return $QuizQuestionObj;
    }

}
