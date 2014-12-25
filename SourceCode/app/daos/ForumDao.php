<?php
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class ForumDao extends BaseDao implements UserInterface, RemindableInterface
{
	use UserTrait, RemindableTrait;
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'forum';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getForum($id) {
        return parent::getObject($id);
    }
    
    public function InsertForum($ForumObj) {
        return parent::InsertObject($ForumObj);
    }
    
    public function UpdateForum($ForumObj, $Id) {
        return parent::UpdateObject($ForumObj, $Id);
    }
    
    public function DeleteForum($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $ForumObj = new Forum();
        $ForumObj->setUserName($rowset["user_name"]);
        $ForumObj->setPassword($rowset["password"]);
        $ForumObj->setCreatedDate($rowset["created_date"]);
        $ForumObj->setIsPublic($rowset["is_public"]);
        return $ForumObj;
    }
}
?>