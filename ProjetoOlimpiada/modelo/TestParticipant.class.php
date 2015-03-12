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
    
    function __construct($id, $participant, $test, $finalized) {
        $this->id = $id;
        $this->participant = $participant;
        $this->test = $test;
        $this->finalized = $finalized;
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
    
}
