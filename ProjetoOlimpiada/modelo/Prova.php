<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Prova
 *
 * @author Luana
 */
class Prova {
    private $id;
    private $nivel;
    private $perguntas;
            
    function __construct($id, $nivel) {
        $this->nivel = $nivel;
        $this->id = $id;
        $this->perguntas = array();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getNivel() {
        return $this->nivel;
    }
    
     public function setId($id) {
        $this->id = $id;
    }
    
    public function setNivel($nivel) {
        $this->nivel = $nivel;
    }
    
     public function addPerguntas($pergunta, $topico){
         $this->perguntas[] = new Pergunta($pergunta, $topico);
    }
    
    public function getPerguntas() {
        return $this->perguntas;
        
    }
}
