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
require_once '../dao/AdministradorDAO.php';
require_once '../dao/AlternativaDAO.php';
require_once '../dao/CompeticaoDAO.php';
require_once '../dao/PerguntaDAO.php';
require_once '../dao/ProvaDAO.php';
require_once '../dao/UsuarioDAO.php';

require_once '../modelo/Administrador.php';
require_once '../modelo/Alternativa.php';
require_once '../modelo/Competicao.php';
require_once '../modelo/Pergunta.php';
require_once '../modelo/Prova.php';
require_once '../modelo/Usuario.php';

class Testando {
    private $administradorDAO;
    private $competicaoDAO;
    private $usuarioDAO;
    private $provaDAO;
    private $perguntaDAO;
    private $alternativaDAO;
    
    public function __construct() {
        $this->administradorDAO = new AdministradorDAO();
        $this->alternativaDAO = new AlternativaDAO();
        $this->competicaoDAO = new CompeticaoDAO();
        $this->perguntaDAO = new PerguntaDAO();
        $this->provaDAO = new ProvaDAO();
        $this->usuarioDAO = new UsuarioDAO();        
    }
   
    function testar() {
     //   $administrador = new Administrador(0,"Luana", "lu@oi.com", "1234");
      //  $this->administradorDAO->addAdministrador($administrador);
      //  $this->administradorDAO->removeAdm(1);
     // $competicao = new Competicao(0, "Computaria", "");
     // $this->competicaoDAO->addCompeticao($competicao);
      //  $participant = new Usuario(0, "Lulu", "lua@eu.com", "123","ADS", 1);
        //$this->usuarioDAO->addUsuario($participant);
        print_r($this->competicaoDAO->listarCompeticoes());
}
    
   
}
