<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class QuizTypeDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'quiz_type';
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
    
    public function getQuizType($id) {
        return parent::getObject($id);
    }
    
    public function InsertQuizType($QuizTypeObj) {
		$result = parent::InsertObjectReturnId($QuizTypeObj);
        if (!is_null($result) && !is_null($QuizTypeObj)) { $QuizTypeObj->setQuizType($result); }
		return $QuizTypeObj;
    }
    
	/*
    public function InsertQuizType($QuizTypeObj) {
        return parent::InsertObject($QuizTypeObj);
    }
	*/
    public function UpdateQuizType($QuizTypeObj, $Id) {
        return parent::UpdateObject($QuizTypeObj, $Id);
    }
    
    public function DeleteQuizType($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $QuizTypeObj = new QuizType();
        
        $QuizTypeObj->setQuizType($rowset["id"]);
        $QuizTypeObj->setName($rowset["name"]);
        return $QuizTypeObj;
    }

}
