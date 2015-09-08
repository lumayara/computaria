<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/TestParticipant.class.php';

/**
 * Description of Choice
 *
 * @author Luana
 */
class Classification {

    private $testParticipant;
    private $conclusionTime;
    private $points;
    private $answered;
    private $rights;

    function __construct($testParticipant, $conclusionTime, $points, $answered, $rights) {
        $this->testParticipant = $testParticipant;
        $this->conclusionTime = $conclusionTime;
        $this->points = $points;
        $this->answered = $answered;
        $this->rights = $rights;
    }

    public function getTestParticipant() {
        return $this->testParticipant;
    }

    public function getConclusionTime() {
        return $this->conclusionTime;
    }

    public function getPoints() {
        return $this->points;
    }

    public function getAnswered() {
        return $this->answered;
    }

    public function getRights() {
        return $this->rights;
    }

    public function setTestParticipant($testParticipant) {
        $this->testParticipant = $testParticipant;
    }

    public function setConclusionTime($conclusionTime) {
        $this->conclusionTime = $conclusionTime;
    }

    public function setPoints($points) {
        $this->points = $points;
    }

    public function setAnswered($answered) {
        $this->answered = $answered;
    }

    public function setRights($rights) {
        $this->rights = $rights;
    }

}
