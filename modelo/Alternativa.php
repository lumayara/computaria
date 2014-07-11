<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Alternativa
 *
 * @author Luana
 */
class Alternativa {
    private $id;
    private $alternativa;
    private $eh_certa;
    private $pergunta;


    public function __construct($id, $alternativa, $eh_certa, $pergunta) {
        $this->id = $id;
        $this->alternativa = $alternativa;
        $this->eh_certa = $eh_certa;
        $this->pergunta = new Pergunta();
    }
    public function getID() {
        return $this->alternativa;
    }
    
    public function getAlternativa() {
        return $this->alternativa;
    }
    
    public function getEh_certa() {
        return $this->eh_certa;
    }
    
    public function setAlternativa($alternativa) {
        $this->alternativa = $alternativa;
    }
    
     public function setEh_certa($eh_certa) {
        $this->eh_certa = $eh_certa;
    }
    
     public function setID($id) {
        $this->id = $id;
    }
    
     public function getPergunta() {
        return $this->pergunta->getId();
    }
}
 