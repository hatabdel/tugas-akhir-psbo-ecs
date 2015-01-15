<?php

class IconService extends BaseService {
    
    private $IconDao;
    
    public function __construct() {
        parent::__construct();
        $this->IconDao = new IconDao();
    }
    
    public function getList() {
        try {
            return $this->IconDao->getList();
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
    
    public function getIcon($id) {
        try { 
            return $this->IconDao->getIcon($id);
        } catch (Exception $ex) {
            $this->addError($ex->getMessage());
            throw new Exception($ex->getMessage());
        }
    }
}

