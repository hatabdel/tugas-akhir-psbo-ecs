<?php

class QuizQuestion {
    private $mId;
    private $mQuiz;
    private $mQuestion;
    private $mAnswerType;
    private $mScore;
    
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setQuiz($value) {
        $this->mQuiz = $value;
    }
    
    public function getQuiz() {
        return $this->mQuiz;
    }
    
    public function setQuestion($value) {
        $this->mQuestion = $value;
    }
    
    public function getQuestion() {
        return $this->mQuestion;
    }
    
    public function setAnswerType($value) {
        $this->mAnswerType = $value;
    }
    
    public function getAnswerType() {
        return $this->mAnswerType;
    }
	
    public function setScore($value) {
        $this->mScore = $value;
    }
    
    public function getScore() {
        return $this->mScore;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "quiz_id" => $this->mQuiz,
            "question" => $this->mQuestion,
            "answer_type_id" => $this->mAnswerType,
            "score" => $this->mScore
        );
    }
}

