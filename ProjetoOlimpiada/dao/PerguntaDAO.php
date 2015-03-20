<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionDAO
 *
 * @author Luana
 */
include_once '../conexao/ConnectionFactory.php';
include_once '../modelo/Question.php';
class QuestionDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addQuestion(Question $question) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO QUESTIONS (id, data_cadastro, question,"
                    . "topico, competition_id) VALUES (:id, :data_cadastro, :question, :topico, :competition_id)");

            $vetorUser = array($question->getId(), $question->getDataCadastro(), $question->getQuestion(),
                $question->getTopico(), $question->getCompetition());
            
            $stmt->bindParam(":id", $vetorUser[0]);
            $stmt->bindParam(":data_cadastro", $vetorUser[1]);
            $stmt->bindParam(":question", $vetorUser[2]);
            $stmt->bindParam(":topico", $vetorUser[3]);
            $stmt->bindParam(":competition_id", $vetorUser[4]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
    public function getQuestion($id){
        try {
            $stmt = $this->conexao->prepare("SELECT question, topico, competition_id FROM QUESTIONS WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
   public function updateQuestion(Question $question){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE QUESTIONS SET question = :question, "
                    . "topico = :topico WHERE id = :id");
            
            $vetorUser = array($question->getQuestion(), $question->getTopico(), $question->getId());
            
            $stmt->bindParam(":question", $vetorUser[0]);
            $stmt->bindParam(":topico", $vetorUser[1]);
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
    
    public function removeQuestion($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM QUESTIONS WHERE id = :id");
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
    
    public function listarQuestoes() {
            try{
        $stmt = $this->conexao->prepare("SELECT id, topico, question, data_cadastro FROM QUESTIONS ORDER BY id DESC");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function listarQuestoesByCompetition($competition_id) {
            try{
        $stmt = $this->conexao->prepare("SELECT id, topico, question, data_cadastro FROM QUESTIONS WHERE competition_id= :competition_id ORDER BY id DESC");
        $stmt->bindParam(":competition_id", $competition_id);
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
}

