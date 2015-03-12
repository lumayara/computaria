<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Competition.class.php';

/**
 * Description of Test
 *
 * @author Luana
 */
class Test {
    private $id;
    private $classification;
    private $competition;
                
    function __construct($id, $classification, $competition) {
        $this->id = $id;
        $this->classification = $classification;
        $this->competitionId = $competition;
    }

    public function getId() {
        return $this->id;
    }

    public function getClassification() {
        return $this->classification;
    }

    public function getCompetition() {
        return $this->competitionId;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setClassification($classification) {
        $this->classification = $classification;
    }

    public function setCompetition($competition) {
        $this->competitionId = $competition;
    }
    
}
