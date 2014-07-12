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
    private $competicao;
    private $nivel;
    private $perguntas;
    
            
    function __construct($nivel, $competicao) {
        $this->nivel = $nivel;
        $this->competicao = $competicao;
        $this->perguntas = array();
    }
    
    public function getCompeticao() {
        return $this->competicao;
    }

    public function getNivel() {
        return $this->nivel;
    }
    
     public function setCompeticao($competicao) {
        $this->competicao = $competicao;
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
