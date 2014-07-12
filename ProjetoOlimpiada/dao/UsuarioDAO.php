<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UsuarioDAO
 *
 * @author Luana
 */
require_once '../conexao/ConnectionFactory.php';
require_once '../modelo/Usuario.php';
class UsuarioDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addUsuario(Usuario $usuario) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO PARTICIPANT (nome, email, senha, turma, id_competicao)"
                    . "VALUES (:nome, :email, :senha, :turma, :id_competicao)");
            $vetorUser = array($usuario->getNome(), $usuario->getEmail(), $usuario->getSenha(), $usuario->getNickname(), $usuario->getCompeticao());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":senha", $vetorUser[2]);
            $stmt->bindParam(":turma", $vetorUser[3]);
            $stmt->bindParam(":id_competicao", $vetorUser[4]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }


    public function listarParticipantes() {
            try{
        $stmt = $this->conexao->prepare("SELECT nome, turma, id_competicao FROM PARTICIPANT");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
            
    }
    
    public function getUsuario($id){
        try {
            $stmt = $this->conexao->prepare("SELECT nome, email, turma, id_competicao FROM PARTICIPANT WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
        
   public function updateUsuario(Usuario $usuario){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE PARTICIPANT SET nome = :nome, email = :email, "
                    . "senha = :senha, turma = :turma, id_competicao = :id_competicao  WHERE id= :id");
            
            $vetorUser = array($usuario->getNome(),$usuario->getEmail(), $usuario->getSenha,
                 $usuario->getTurma(), $usuario->getCompeticao(), $usuario->getID());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":senha", $vetorUser[2]);
            $stmt->bindParam(":turma", $vetorUser[3]);
            $stmt->bindParam(":id_competicao", $vetorUser[4]);
            $stmt->bindParam(":id", $vetorUser[5]);
           
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    public function removeUsuario($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM USUARIO WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $resultado = $stmt->execute();
            if($resultado){
                $removido = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $removido;
    }  
    
     public function validaUsuario($email, $senha) {
        $valido = FALSE;
        try{
            $stmt = $this->conexao->prepare("SELECT nome, turma,email FROM USUARIO WHERE email =:email and senha =:senha");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            
            $resultado = $stmt->execute();
            
            if ($resultado) {
                $valido = TRUE;
            }
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $valido;    
    }
    
    
}
