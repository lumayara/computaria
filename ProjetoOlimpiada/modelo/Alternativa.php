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


    public function __construct($id, $alternativa, $eh_certa) {
        $this->id = $id;
        $this->alternativa = $alternativa;
        $this->eh_certa = $eh_certa;
    }
    public function getID() {
        return $this->id;
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
  
}
 