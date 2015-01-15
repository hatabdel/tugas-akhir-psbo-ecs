<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class IconDao extends BaseDao implements UserInterface, RemindableInterface 
{

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'icon';
    protected $primary_key = 'id';
    protected $fillable = array('name');
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	public function getList($filter = null) {
        return parent::getList($filter);
    }
    
    public function getIcon($id) {
        return parent::getObject($id);
    }
    
    function toObject($rowset) {
        $IconObj = new Icon();
        $IconObj->setId($rowset["id"]);
        $IconObj->setName($rowset["name"]);
        return $IconObj;
    }

}
