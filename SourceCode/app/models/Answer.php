<?php

class Answer {
    private $mAnswer;
    private $mSequence;
    private $mQuizQuestion;
    private $mContent;
    private $mIsCorrect;
    
    public function setAnswer($value) {
        $this->mAnswer = $value;
    }
    
    public function getAnswer() {
        return $this->mAnswer;
    }
    
    public function setSequence($value) {
        $this->mSequence = $value;
    }
    
    public function getSequence() {
        return $this->mSequence;
    }
    
    public function setQuizQuestion($value) {
        $this->mQuizQuestion = $value;
    }
    
    public function getQuizQuestion() {
        return $this->mQuizQuestion;
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
			"id" => $this->mAnswer,
            "sequence" => $this->mSequence,
            "quiz_question_id" => $this->mQuizQuestion,
            "content" => $this->mContent,
            "is_correct" => $this->mIsCorrect
        );
    }
}

