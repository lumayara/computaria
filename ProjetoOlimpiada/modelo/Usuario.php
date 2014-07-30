<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuario
 *
 * @author Luana
 */
class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $turma;
    private $competicao;
    private $prova;
            
    function __construct($id, $nome, $email, $senha,$turma, $competicao, $prova) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->turma = $turma;
        $this->competicao = $competicao;
        $this->prova = prova;
                
    }
    
    public function getID() {
        return $this->nome;
    }
    
    public function getNome() {
        return $this->nome;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getSenha() {
        return $this->senha;
    }
    
    public function getTurma() {
        return $this->turma;
    }
    
     public function getProva() {
        return $this->prova;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
    
    public function setNome($nome) {
        $this->nome = $nome;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setSenha($senha){
        $this->senha = $senha;
    }
    
    public function setTurma($turma){
        $this->turma = $turma;
    }
    
    public function getCompeticao() {
        return $this->competicao;    
    }
    
    public function setCompeticao($competicao) {
        $this->competicao->$competicao;    
    }
    
    public function setProva($prova) {
        $this->prova->$prova;    
    }
}

