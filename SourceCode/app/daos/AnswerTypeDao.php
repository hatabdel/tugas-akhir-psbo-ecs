<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AnswerTypeDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'answer_type';
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
    
    public function getAnswerType($id) {
        return parent::getObject($id);
    }
    
    public function InsertAnswerType($AnswerTypeObj) {
		$result = parent::InsertObjectReturnId($AnswerTypeObj);
        if (!is_null($result) && !is_null($AnswerTypeObj)) { $AnswerTypeObj->setId($result); }
		return $AnswerTypeObj;
    }
    
    public function UpdateAnswerType($AnswerTypeObj, $Id) {
        return parent::UpdateObject($AnswerTypeObj, $Id);
    }
    
    public function DeleteAnswerType($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $AnswerTypeObj = new AnswerType();
        $AnswerTypeObj->setId($rowset["id"]);
        $AnswerTypeObj->setName($rowset["name"]);
        return $AnswerTypeObj;
    }

}
