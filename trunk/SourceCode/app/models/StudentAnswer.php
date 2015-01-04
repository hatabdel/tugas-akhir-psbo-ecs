<?php

class StudentAnswer {
    private $mStudentAnswerId;
    private $mStudentQuizId;
    private $mQuizQuestionId;
    private $mStudentAnswer;
    private $mScore;
    private $mIsCorrect;
    
    public function setStudentAnswerId($value) {
        $this->mStudentAnswerId = $value;
    }
    
    public function getStudentAnswerId() {
        return $this->mStudentAnswerId;
    }
    
    public function setStudentQuizId($value) {
        $this->mStudentQuizId = $value;
    }
    
    public function getStudentQuizId() {
        return $this->mStudentQuizId;
    }
    
    public function setQuizQuestionId($value) {
        $this->mQuizQuestionId = $value;
    }
    
    public function getQuizQuestionId() {
        return $this->mQuizQuestionId;
    }
    
    public function setStudentAnswer($value) {
        $this->mStudentAnswer = $value;
    }
    
    public function getStudentAnswer() {
        return $this->mStudentAnswer;
    }
	
    public function setScore($value) {
        $this->mScore = $value;
    }
    
    public function getScore() {
        return $this->mScore;
    }
   
    public function setIsCorrect($value) {
        $this->mIsCorrect = $value;
    }
    
    public function IsCorrect() {
        return $this->mIsCorrect;
    }
    
    public function toArray() {
        return array(
            "student_answer_id" => $this->mStudentAnswerId,
            "student_quiz_id" => $this->mStudentQuizId,
            "quiz_question_id" => $this->mQuizQuestionId,
            "student_answer" => $this->mStudentAnswer,
            "score" => $this->mScore,
            "is_correct" => $this->mIsCorrect
        );
    }
}

