<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Choice
 *
 * @author Luana
 */
include_once '../conexao/ConnectionFactory.php';
include_once '../modelo/Choice.php';
class ChoiceDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addChoice(Choice $choice, $id_question) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO CHOICES (Choice, eh_resposta, id_question)"
                    . "VALUES (:Choice, :eh_resposta, :id_question)");
            $vetorUser = array($choice->getChoice(), $choice->getEh_certa());
            
            $stmt->bindParam(":Choice", $vetorUser[0]);
            $stmt->bindParam(":eh_resposta", $vetorUser[1]);
            $stmt->bindParam(":id_question", $id_question);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updateChoice(Choice $choice){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE CHOICES SET Choice = :Choice, "
                    . "eh_resposta = :eh_resposta WHERE id = :id");
            
            $vetorUser = array($choice->getChoice(), $choice->getEh_certa(), $choice->getID());
            
            $stmt->bindParam(":Choice", $vetorUser[0]);
            $stmt->bindParam(":eh_resposta", $vetorUser[1]);
            $stmt->bindParam(":id", $vetorUser[2]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
     public function getChoice($id){
        try {
            $stmt = $this->conexao->prepare("SELECT Choice, eh_resposta, id_question FROM CHOICES WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function removeChoice($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM CHOICES WHERE id = :id");
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
    
    public function listarChoices() {
            try{
        $stmt = $this->conexao->prepare("SELECT id, Choice, eh_resposta FROM CHOICES ORDER BY id DESC");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function listarChoicesByQuestao($id_question) {
            try{
        $stmt = $this->conexao->prepare("SELECT id, Choice, eh_resposta FROM CHOICES WHERE id_question= :id_question ORDER BY id DESC");
        $stmt->bindParam(":id_question", $id_question);
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
}
