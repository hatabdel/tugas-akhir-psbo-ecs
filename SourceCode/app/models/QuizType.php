<?php

class QuizType {
    private $mQuizType;
    private $mName;
	
    public function setQuizType($value) {
        $this->mQuizType = $value;
    }
    
    public function getQuizType() {
        return $this->mQuizType;
    }
    
    public function setName($value) {
        $this->mName = $value;
    }
    
    public function getName() {
        return $this->mName;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mQuizType,
            "name" => $this->mName
        );
    }
}

