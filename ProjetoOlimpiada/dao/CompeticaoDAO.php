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
class CompeticaoDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addCompeticao(Competicao $comp) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO COMPETITION (nome, data_realizacao)"
                    . "VALUES (:nome, :data_realizacao)");
            $vetorUser = array($comp->getNome(), $comp->getData());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":data_realizacao", $vetorUser[1]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updateComp(Competicao $comp){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE COMPETITION SET nome = :nome, "
                    . "data_realizacao = :data_realizacao WHERE id = :id");
            
            $vetorUser = array($comp->getNome(), $comp->getData());
            
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":data_realizacao", $vetorUser[1]);
           
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
