<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of competicao
 *
 * @author Luana
 */

class Competicao {
    private $id;
    private $nome;
    private $data_realizacao;
                
    function __construct($id, $nome, $data_realizacao) {
        $this->nome = $nome;
        $this->id = $id;
        $this->data_realizacao= $data_realizacao;
    }
    
    public function getNome() {
        return $this->nome;
    }
   
    public function getId() {
        return $this->id;
    }
  
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
     public function getData() {
        return $this->data_realizacao;
    }
  
    public function setData($data_realizacao) {
        $this->data_realizacao = $data_realizacao;
    }
    
}
