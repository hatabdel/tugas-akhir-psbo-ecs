<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class AttachmentDao extends BaseDao implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'attachment';
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList() {
        return parent::getList();
    }
    
    public function getAttachment($id) {
        return parent::getObject($id);
    }
    
    public function InsertAttachment($AttachmentObj) {
        return parent::InsertObject($AttachmentObj);
    }
    
    public function UpdateAttachment($AttachmentObj, $Id) {
        return parent::UpdateObject($AttachmentObj, $Id);
    }
    
    public function DeleteAttachment($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $AttachmentObj = new Attachment();
        $AttachmentObj->setUserName($rowset["user_name"]);
        $AttachmentObj->setPassword($rowset["password"]);
        $AttachmentObj->setCreatedDate($rowset["created_date"]);
        $AttachmentObj->setIsActive($rowset["is_active"]);
        return $AttachmentObj;
    }

}
