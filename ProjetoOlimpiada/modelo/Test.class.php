<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Competition.class.php';

/**
 * Description of Test
 *
 * @author Luana
 */
class Test {

    private $id;
    private $classification;
    private $competition;
    private $startDate;
    private $endDate;

    function __construct($id, $classification, $startDate, $endDate, $competition) {
        $this->id = $id;
        $this->classification = $classification;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->competition = $competition;
    }

    public function getId() {
        return $this->id;
    }

    public function getClassification() {
        return $this->classification;
    }

    public function getCompetition() {
        return $this->competition;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setClassification($classification) {
        $this->classification = $classification;
    }

    public function setCompetition($competition) {
        $this->competition = $competition;
    }

    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }

    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }

}
