<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/TestParticipant.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Question.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Choice.class.php';

/**
 * Description of Answers
 *
 * @author Luana
 */
class Answers {

    private $id;
    private $testParticipant;
    private $question;
    private $choice;

    function __construct($id, $testParticipant, $question, $choice) {
        $this->id = $id;
        $this->testParticipant = $testParticipant;
        $this->question = $question;
        $this->choice = $choice;
    }

    public function getId() {
        return $this->id;
    }

    public function getTestParticipant() {
        return $this->testParticipant;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getChoice() {
        return $this->choice;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setTestParticipant($testParticipant) {
        $this->testParticipant = $testParticipant;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function setChoice($choice) {
        $this->choice = $choice;
    }

}
