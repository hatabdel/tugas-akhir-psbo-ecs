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
    
    public function getForum($id) {
        return parent::getObject($id);
    }
    
    public function InsertForum($ForumObj) {
        $result = parent::InsertObjectReturnId($ForumObj);
        if (!is_null($result) && !is_null($ForumObj)) { $ForumObj->setId($result); }
        return $ForumObj;
    }
    
    public function UpdateForum($ForumObj, $Id) {
        return parent::UpdateObject($ForumObj, $Id);
    }
    
    public function DeleteForum($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $ForumObj = new Forum();
        $ForumObj->setId($rowset["id"]);
        $ForumObj->setTitle($rowset["title"]);
        $ForumObj->setContent($rowset["content"]);
        $ForumObj->setIsPublic($rowset["is_public"]);
		$ForumObj->setCreatedDate($rowset["created_date"]);
        return $ForumObj;
    }
}
?>