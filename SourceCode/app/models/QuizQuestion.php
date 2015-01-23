<?php

class QuizQuestion {
    private $mId;
    private $mQuiz;
    private $mQuestion;
    private $mAnswerType;
    private $mScore;
    private $mAnswers;
    private $mCorrectAnswers;
    private $mIsLoaded;
    
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
         if (!is_null($this->mQuiz) && !empty($this->mQuiz)) {
            if (!$this->mQuiz->IsLoaded()) {
                $QuizDao = new QuizDao();
                $this->mQuiz = $QuizDao->getQuiz($this->mQuiz->getId());
                if (!is_null($this->mQuiz)) { $this->mQuiz->setIsLoaded(true); }
            }
        }
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
    
    public function setAnswers($value) {
        $this->mAnswers = $value;
    }
    
    public function getAnswers() {
        if (!is_null($this->mId) && is_null($this->mAnswers)) {
            $AnswerFilter = new AnswerFilter();
            $AnswerFilter->setQuizQuestionId($this->mId);
            $AnswerDao = new AnswerDao();
            $this->mAnswers = $AnswerDao->getList($AnswerFilter);
        }
        return $this->mAnswers;
    }
    
    public function getCorrectAnswers() {
        $this->mCorrectAnswers = array();
        if (!is_null($this->mId)) {
            $AnswerFilter = new AnswerFilter();
            $AnswerFilter->setQuizQuestionId($this->mId);
            $AnswerFilter->setIsCorrect(1);
            $AnswerDao = new AnswerDao();
            $Answers = $AnswerDao->getList($AnswerFilter);
            if (!is_null($Answers) && count($Answers)) {
                foreach ($Answers as $item) {
                    $this->mCorrectAnswers[] = $item->getId();
                }
            }
        }
        return $this->mCorrectAnswers;
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
            "quiz_id" => (!is_null($this->mQuiz) ? $this->mQuiz->getId() : null),
            "question" => $this->mQuestion,
            "score" => $this->mScore
        );
    }
}

