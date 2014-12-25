<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class CommentDao extends BaseDao implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'comment';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getComment($id) {
        return parent::getObject($id);
    }
    
    public function InsertComment($CommentObj) {
        return parent::InsertObject($CommentObj);
    }
    
    public function UpdateComment($CommentObj, $Id) {
        return parent::UpdateObject($CommentObj, $Id);
    }
    
    public function DeleteComment($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $CommentObj = new Comment();
        $CommentObj->setUserName($rowset["user_name"]);
        $CommentObj->setPassword($rowset["password"]);
        $CommentObj->setCreatedDate($rowset["created_date"]);
        //$CommentObj->setIsActive($rowset["is_active"]);
        return $CommentObj;
    }

}
