<?php

class QuizQuestion {
    private $mQuizQuestionId;
    private $mQuizId;
    private $mQuestion;
    private $mAnswerTypeId;
    private $mScore;
    
    public function setQuizQuestionId($value) {
        $this->mQuizQuestionId = $value;
    }
    
    public function getQuizQuestionId() {
        return $this->mQuizQuestionId;
    }
    
    public function setQuizId($value) {
        $this->mQuizId = $value;
    }
    
    public function getQuizId() {
        return $this->mQuizId;
    }
    
    public function setQuestion($value) {
        $this->mQuestion = $value;
    }
    
    public function getQuestion() {
        return $this->mQuestion;
    }
    
    public function setAnswerTypeId($value) {
        $this->mAnswerTypeId = $value;
    }
    
    public function getAnswerTypeId() {
        return $this->mAnswerTypeId;
    }
	
    public function setScore($value) {
        $this->mScore = $value;
    }
    
    public function getScore() {
        return $this->mScore;
    }
    
    public function toArray() {
        return array(
            "quiz_question_id" => $this->mQuizQuestionId,
            "quiz_id" => $this->mQuizId,
            "question" => $this->mQuestion,
            "answer_type_id" => $this->mAnswerTypeId,
            "score" => $this->mScore
        );
    }
}

