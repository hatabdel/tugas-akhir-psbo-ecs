<?php

class BaseDao extends Dao {
    
    private $error = "";
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function getList($filter = null) {
        $list = null;
        if (is_null($filter)) {
            $list = parent::all();
        } else {
            $list = DB::table($this->table)->whereRaw($filter->getWhereQuery())->get();
        }
        
        $obj_arr = array();
        if (!is_null($list)) {
            $list_arr = array();
            if (is_array($list)) {
                $list_arr = $list;
            } else {
                $list_arr = $list->toArray();
            }

            foreach ($list_arr as $item) {
                if(!is_array($item)) { $item = get_object_vars($item); }
                $obj_arr[] = $this->toObject($item);
            }
        }
        return $obj_arr;
    }
    
    protected function getObject($id) {
        if (is_null($id) || empty($id)) { return null; }
        $obj = DB::table($this->table)->where($this->primary_key, $id)->get();
        if (is_null($obj) || empty($obj) || count($obj) <= 0) { return null; }
        $obj = get_object_vars($obj[0]);
        return $this->toObject($obj);
    }
    
    protected function InsertObject($object) {
        if (is_null($object) || empty($object)) { return false; }
        $result = DB::table($this->table)->insert($object->toArray());
        if ($result > 0) { return true; }
    }
    
    protected function InsertObjectReturnId($object) {
		if (is_null($object) || empty($object)) { return null; }
		$result = DB::table($this->table)->insertGetId($object->toArray());
		if (!is_null($result) && !empty($result)) { return $result; }
		return null;
    }
    
    protected function UpdateObject($object, $id) {
        if (is_null($object) || empty($object)) { return false; }
        DB::table($this->table)->where($this->primary_key, $id)->update($object->toArray());
        return true;
    }
    
    protected function DeleteObject($id) {
        if (is_null($id) || empty($id)) { return false; }
        DB::table($this->table)->where($this->primary_key, $id)->delete();
        return true;
    }
    
    protected function addError($message) {
        $this->error = $message;
    }
    
    public function getError() {
        return $this->error;
    }
    
    public function getDaoState() {
        if(!empty($this->arr_error)) { return true; }
        return false;
    }
}