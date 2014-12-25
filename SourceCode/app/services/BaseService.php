<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class BaseService {
    
    private $arr_error = array();
    public function __construct() {
        
    }
    
    protected function addError($message) {
        $this->arr_error[] = $message;
    }
    
    public function getErrors() {
        return $this->arr_error;
    }
    
    public function getServiceState() {
        if(count($this->arr_error) <= 0) { return true; }
        return false;
    }
}
