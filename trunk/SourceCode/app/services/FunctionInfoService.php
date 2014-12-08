<?php

class FunctionInfoService extends BaseService {
    
    private $FunctionInfoDao;
    
    public function __construct() {
        parent::__construct();
        //$this->FunctionInfoDao = new FunctionInfoDao;
    }
    
    public function getList() {
        try {
            //return $this->FunctionInfoDao->getList();
        } catch (Exception $ex) {
            
        }
    }
}

