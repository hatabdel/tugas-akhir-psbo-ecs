<?php

class Answer {
    private $mId;
    private $mSequence;
    private $mQuizQuestionId;
    private $mContent;
    private $mIsCorrect;
    
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setSequence($value) {
        $this->mSequence = $value;
    }
    
    public function getSequence() {
        return $this->mSequence;
    }
    
    public function setQuizQuestionId($value) {
        $this->mQuizQuestionId = $value;
    }
    
    public function getQuizQuestionId() {
        return $this->mQuizQuestionId;
    }
    
    public function setContent($value) {
        $this->mContent = $value;
    }
    
    public function getContent() {
        return $this->mContent;
    }
	
    public function setIsCorrect($value) {
        $this->mIsCorrect = $value;
    }
    
    public function IsCorrect() {
        return $this->mIsCorrect;
    }
    
    public function toArray() {
        return array(
			"id" => $this->mId,
            "sequence" => $this->mSequence,
            "quiz_question_id" => $this->mQuizQuestionId,
            "content" => $this->mContent,
            "is_correct" => $this->mIsCorrect
        );
    }
}

