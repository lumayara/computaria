<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Perguntas
 *
 * @author Luana
 */
class Pergunta {
    private $id;
    private $pergunta;
    private $topico;
    private $alternativas;
            
    function __construct($id, $pergunta, $topico) {
        $this->pergunta = $pergunta;
        $this->topico = $topico;
        $this->id = $id;
        $this->alternativas = array();
    }
    
    public function getId() {
        return $this->id;
    }

    public function getPergunta() {
        return $this->pergunta;
    }
    
    public function getTopico() {
        return $this->topico;
    }
    
     public function setId($id) {
        $this->id = $id;
    }
    
    public function setPergunta($pergunta) {
        $this->pergunta = $pergunta;
    }
    
    public function setTopico($topico) {
        $this->topico = $topico;
    }
    
     public function addAlternativas($alternativa,$eh_certa){
        $alt = new Alternativa($alternativa, $eh_certa);
        if(strcasecmp($eh_certa, "true")){
            $alternativas[] = array('true' => $alternativa);
        }else{
            $alternativas[] = $alt;
        }   
    }
    
    public function getAlternativas() {
        return $this->alternativas;
        
    }
}
