<?php

class Answer {
    private $mId;
    private $mSequence;
    private $mQuizQuestion;
    private $mContent;
    private $mIsCorrect;
    private $mIsLoaded;
    
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
    
    public function setQuizQuestion($value) {
        $this->mQuizQuestion = $value;
    }
    
    public function getQuizQuestion() {
        if (!is_null($this->mQuizQuestion) && !empty($this->mQuizQuestion)) {
            if (!$this->mQuizQuestion->IsLoaded()) {
                $QuizQuestionDao = new QuizQuestionDao();
                $this->mQuizQuestion = $QuizQuestionDao->getQuizQuestion($this->mQuizQuestion->getId());
                if (!is_null($this->mQuizQuestion)) { $this->mQuizQuestion->setIsLoaded(true); }
            }
        }
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
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function toArray() {
        return array(
			"id" => $this->mId,
            "sequence" => $this->mSequence,
            "quiz_question_id" => (!is_null($this->mQuizQuestion) ? $this->mQuizQuestion->getId() : null),
            "content" => $this->mContent,
            "is_correct" => $this->mIsCorrect
        );
    }
}

