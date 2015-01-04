<?php

class QuizType {
    private $mId;
    private $mName;
	
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setName($value) {
        $this->mName = $value;
    }
    
    public function getName() {
        return $this->mName;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "name" => $this->mName
        );
    }
}

