<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Testando
 *
 * @author Luana
 */
require_once '../dao/AdministratorDAO.php';
require_once '../dao/ChoiceDAO.php';
require_once '../dao/CompetitionDAO.php';
require_once '../dao/QuestionDAO.php';
require_once '../dao/ProvaDAO.php';
require_once '../dao/ParticipantDAO.php';

require_once '../modelo/Administrator.php';
require_once '../modelo/Choice.php';
require_once '../modelo/Competition.php';
require_once '../modelo/Question.php';
require_once '../modelo/Prova.php';
require_once '../modelo/Usuario.php';

class Testando {
    private $AdministratorDAO;
    private $competitionDAO;
    private $participantDAO;
    private $provaDAO;
    private $questionDAO;
    private $choiceDAO;
    
    public function __construct() {
        $this->AdministratorDAO = new AdministratorDAO();
        $this->ChoiceDAO = new ChoiceDAO();
        $this->competitionDAO = new CompetitionDAO();
        $this->questionDAO = new QuestionDAO();
        $this->provaDAO = new ProvaDAO();
        $this->participantDAO = new ParticipantDAO();        
    }
   
    function testar() {
     //   $Administrator = new Administrator(0,"Luana", "lu@oi.com", "1234");
      //  $this->AdministratorDAO->addAdministrator($Administrator);
      //  $this->AdministratorDAO->removeAdm(1);
     // $competition = new Competition(0, "Computaria", "");
     // $this->competitionDAO->addCompetition($competition);
      //  $participant = new Usuario(0, "Lulu", "lua@eu.com", "123","ADS", 1);
        //$this->participantDAO->addUsuario($participant);
        print_r($this->competitionDAO->listarCompeticoes());
}
    
   
}
