<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testeBanco
 *
 * @author Luana
 */
require_once '../dao/UsuarioDAO.php';
require_once '../modelo/Usuario.php';
class testeBanco {
    private $usuarioDao;
    
    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }
    
    public function testes() {

    $usuario = new Usuario("Luana", "lumayara.ads@gmail.com", "123", "lulu");
    $this->usuarioDao->addUsuario($usuario);
    } 
}
