<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Question.class.php';

/**
 * Description of Choice
 *
 * @author Luana
 */
class Choice{
    
    private $id;
    private $choice;
    private $itsAnswer;
    private $question;
    
    function __construct($id, $choice, $itsAnswer, $question) {
        $this->id = $id;
        $this->choice = $choice;
        $this->itsAnswer = $itsAnswer;
        $this->question = $question;
    }

    public function getId() {
        return $this->id;
    }

    public function getChoice() {
        return $this->choice;
    }

    public function getItsAnswer() {
        return $this->itsAnswer;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setChoice($choice) {
        $this->choice = $choice;
    }

    public function setItsAnswer($itsAnswer) {
        $this->itsAnswer = $itsAnswer;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

}
