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
	protected $primary_key = 'id';
    protected $fillable = array('id');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter=null) {
        return parent::getList($filter);
    }
    
    public function getListPaging($filter = null, $limit = 0, $offset = 0) {
        return parent::getListPaging($filter, $limit, $offset);
    }
    
    public function getListCount($filter = null) {
        return parent::getRowCount($filter);
    }
    
    public function getComment($id) {
        return parent::getObject($id);
    }
    
    public function InsertComment($CommentObj) {
		
        $result = parent::InsertObjectReturnId($CommentObj);
        if (!is_null($result) && !is_null($CommentObj)) { $CommentObj->setId($result); }
        return $CommentObj;
    }
    
    public function UpdateComment($CommentObj, $Id) {
        return parent::UpdateObject($CommentObj, $Id);
    }
    
    public function DeleteComment($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $CommentObj = new Comment();
        $CommentObj->setId($rowset["id"]);
        $CommentObj->setTitle($rowset["title"]);
        $CommentObj->setContent($rowset["content"]);
        $CreatedUser = new UserInfo();
        $CreatedUser->setUserName($rowset['created_user']);
        $CreatedUser->setIsLoaded(false);
        $CommentObj->setCreatedUser($CreatedUser);
		$CommentObj->setCreatedDate($rowset["created_date"]);
        $ForumObj = new Forum();
        $ForumObj->setId($rowset["forum_id"]);
        $ForumObj->setIsLoaded(false);
		$CommentObj->setForum($ForumObj);
        return $CommentObj;
    }

}
