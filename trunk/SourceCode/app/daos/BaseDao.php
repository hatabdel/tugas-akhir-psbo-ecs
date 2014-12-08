<?php

class BaseDao extends Dao {
    
    public function __construct() {
        parent::__construct();
    }
    
    protected function getList() {
        $list = parent::all();
        $list_arr = $list->toArray();
        $obj_arr = array();
        foreach ($list_arr as $item) {
            $obj_arr[] = $this->toObject($item);
        }
        
        return $obj_arr;
    }
    
    protected function getObject($id) {
        
    }
    
    protected function InsertObject($object) {
        
    }
    
    protected function UpdateObject($object, $id) {
        
    }
    
    protected function DeleteObject($id) {
        
    }
}