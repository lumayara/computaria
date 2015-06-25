<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Participant.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Test.class.php';

/**
 * Description of TestParticipant
 *
 * @author Luana
 */
class TestParticipant {
    
    private $id;
    private $participant;
    private $test;
    private $finalized;
    private $startTime;
    private $endTime;
    
    function __construct($id, $participant, $test, $finalized, $startTime, $endTime) {
        $this->id = $id;
        $this->participant = $participant;
        $this->test = $test;
        $this->finalized = $finalized;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    public function getId() {
        return $this->id;
    }

    public function getParticipant() {
        return $this->participant;
    }

    public function getTest() {
        return $this->test;
    }

    public function getFinalized() {
        return $this->finalized;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setParticipant($participant) {
        $this->participant = $participant;
    }

    public function setTest($test) {
        $this->test = $test;
    }

    public function setFinalized($finalized) {
        $this->finalized = $finalized;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }
    
}
