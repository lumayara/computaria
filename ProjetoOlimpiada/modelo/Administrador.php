<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Administrador
 *
 * @author Luana
 */
class Administrador{
    private $id;
    private $email;
    private $senha;

    
    function __construct($id, $email, $senha) {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $senha;              
    }
    
    public function getID() {
        return $this->id;
    }
 
    public function getEmail() {
        return $this->email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
}
