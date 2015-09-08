<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Competition.class.php';

/**
 * Description of Participant
 *
 * @author Luana
 */
class Participant {
    
    private $id;
    private $name;
    private $email;
    private $password;
    private $team;
    private $competition;
    
    function __construct($id, $name, $email, $password, $team, $competition) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->team = $team;
        $this->competition = $competition;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getTeam() {
        return $this->team;
    }

    public function getCompetition() {
        return $this->competition;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTeam($team) {
        $this->team = $team;
    }

    public function setCompetition($competition) {
        $this->competition = $competition;
    }
    
}
