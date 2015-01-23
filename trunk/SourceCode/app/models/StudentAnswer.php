<?php

class StudentAnswer {
    private $mId;
    private $mStudentQuiz;
    private $mQuizQuestion;
    private $mAnswer;
    private $mScore;
    private $mIsCorrect;
    private $mIsLoaded;
    
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
        if (!is_null($this->mStudentQuiz) && !empty($this->mStudentQuiz)) {
            if (!$this->mStudentQuiz->IsLoaded()) {
                $StudentQuizDao = new StudentQuizDao();
                $this->mStudentQuiz = $StudentQuizDao->getStudentQuiz($this->mStudentQuiz->getId());
                if (!is_null($this->mStudentQuiz)) { $this->mStudentQuiz->setIsLoaded(true); }
            }
        }
        return $this->mStudentQuiz;
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
    
    public function setAnswer($value) {
        $this->mAnswer = $value;
    }
    
    public function getAnswer() {
        if (!is_null($this->mAnswer) && !empty($this->mAnswer)) {
            if (!$this->mAnswer->IsLoaded()) {
                $AnswerDao = new AnswerDao();
                $this->mAnswer = $AnswerDao->getAnswer($this->mAnswer->getId());
                if (!is_null($this->mAnswer)) { $this->mAnswer->setIsLoaded(true); }
            }
        }
        return $this->mAnswer;
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
    
    public function setIsLoaded($value) {
        $this->mIsLoaded = $value;
    }
    
    public function IsLoaded() {
        return $this->mIsLoaded;
    }
    
    public function toArray() {
        return array(
            "id" => $this->mId,
            "student_quiz_id" => (!is_null($this->mStudentQuiz) ? $this->mStudentQuiz->getId() : null),
            "quiz_question_id" => (!is_null($this->mQuizQuestion) ? $this->mQuizQuestion->getId() : null),
            "answer_id" => (!is_null($this->mAnswer) ? $this->mAnswer->getId() : null),
            "score" => $this->mScore,
            "is_correct" => $this->mIsCorrect
        );
    }
}

