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
    
    public function getAttachment($id) {
        return parent::getObject($id);
    }
    
    public function InsertAttachment($AttachmentObj) {
        $result = parent::InsertObjectReturnId($AttachmentObj);
        if (!is_null($result) && !is_null($AttachmentObj)) { $AttachmentObj->setId($result); }
        return $AttachmentObj;
    }
    
    public function UpdateAttachment($AttachmentObj, $Id) {
        return parent::UpdateObject($AttachmentObj, $Id);
    }
    
    public function DeleteAttachment($Id) {
        return parent::DeleteObject($Id);
    }
    
    function toObject($rowset) {
        $AttachmentObj = new Attachment();
        $AttachmentObj->setId($rowset["id"]);
        $AttachmentObj->setFunctionId($rowset["function_id"]);
        $AttachmentObj->setRecordId($rowset["record_id"]);
        $AttachmentObj->setFileName($rowset["file_name"]);
        $AttachmentObj->setFileType($rowset["file_type"]);
        $AttachmentObj->setFileExtention($rowset["file_extention"]);
        $AttachmentObj->setFilePath($rowset["file_path"]);
        $AttachmentObj->setDescription($rowset["description"]);
        $AttachmentObj->setCreatedDate($rowset["created_date"]);
        $UserInfoObj = new UserInfo();
        $UserInfoObj->setUserName($rowset["created_user"]);
        $UserInfoObj->setIsLoaded(false);
        $AttachmentObj->setCreatedDate($UserInfoObj);
        return $AttachmentObj;
    }

}
