<?php

class StudentAnswer {
    private $mId;
    private $mStudentQuiz;
    private $mQuizQuestion;
    private $mStudentAnswer;
    private $mScore;
    private $mIsCorrect;
    
    public function setId($value) {
        $this->mId = $value;
    }
    
    public function getId() {
        return $this->mId;
    }
    
    public function setStudentQuiz($value) {
        $this->mStudentQuiz = $value;
    }
    
    public function getStudentQuiz() {
        return $this->mStudentQuiz;
    }
    
    public function setQuizQuestion($value) {
        $this->mQuizQuestion = $value;
    }
    
    public function getQuizQuestion() {
        return $this->mQuizQuestion;
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
            "id" => $this->mId,
            "student_quiz_id" => $this->mStudentQuiz,
            "quiz_question_id" => $this->mQuizQuestion,
            "student_answer" => $this->mStudentAnswer,
            "score" => $this->mScore,
            "is_correct" => $this->mIsCorrect
        );
    }
}

