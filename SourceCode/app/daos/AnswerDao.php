<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AnswerDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'answer';
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
    
    public function getAnswer($id) {
        return parent::getObject($id);
    }
    
    public function InsertAnswer($AnswerObj) {
		$result = parent::InsertObjectReturnId($AnswerObj);
        if (!is_null($result) && !is_null($AnswerObj)) { $AnswerObj->setAnswer($result); }
		return $AnswerObj;
    }
    
    public function UpdateAnswer($AnswerObj, $Id) {
        return parent::UpdateObject($AnswerObj, $Id);
    }
    
    public function DeleteAnswer($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $AnswerObj = new Answer();
        
        $AnswerObj->setAnswer($rowset["id"]);
        $AnswerObj->setSequence($rowset["sequence"]);
        $AnswerObj->setQuizQuestion($rowset["quiz_question_id"]);
        $AnswerObj->setContent($rowset["content"]);
        $AnswerObj->setIsCorrect($rowset["is_correct"]);
        return $AnswerObj;
    }

}
