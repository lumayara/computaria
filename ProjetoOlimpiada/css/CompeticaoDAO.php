<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompeticaoDAO
 *
 * @author Luana
 */
require_once '../modelo/Competicao.php';
require_once '../conexao/ConnectionFactory.php';
class CompeticaoDAO {
     private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addCompeticao(Competicao $competicao) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO COMPETITION (nome)"
                    . "VALUES (:nome)");
            $vetorUser = array($usuario->getNome());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }


    public function listarCompeticoes() {
            try{
        $stmt = $this->conexao->prepare("SELECT nome FROM COMPETITION");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
            
    }
    
    public function getCompeticao($id){
        try {
            $stmt = $this->conexao->prepare("SELECT nome FROM COMPETITION WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
        
   public function updateCompeticao(Competicao $competicao){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE COMPETITION SET nome = :nome WHERE id= :id");
            
            $vetorUser = array($competicao->getNome(),$competicao->getId());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
          
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    public function removeCompeticao($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM COMPETITION WHERE id = :id");
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
    
}
