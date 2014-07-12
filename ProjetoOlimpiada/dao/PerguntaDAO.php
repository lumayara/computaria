<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PerguntaDAO
 *
 * @author Luana
 */
include_once '../conexao/ConnectionFactory.php';
include_once '../modelo/Pergunta.php';
class PerguntaDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addPergunta(Pergunta $pergunta, $nivel) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO QUESTIONS (pergunta, topico, nivel_prova)"
                    . "VALUES (:pergunta, :topico, :nivel_prova)");
            $vetorUser = array($pergunta->getPergunta(), $pergunta->getTopico());
            
            $stmt->bindParam(":pergunta", $vetorUser[0]);
            $stmt->bindParam(":topico", $vetorUser[1]);
            $stmt->bindParam(":nivel_prova", $nivel);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updatePergunta(Pergunta $pergunta){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE QUESTIONS SET pergunta = :pergunta, "
                    . "topico = :topico WHERE id = :id");
            
            $vetorUser = array($pergunta->getPergunta(), $pergunta->getTopico(), $pergunta->getId());
            
            $stmt->bindParam(":pergunta", $vetorUser[0]);
            $stmt->bindParam(":topico", $vetorUser[1]);
            $stmt->bindParam(":id", $vetorUser[1]);
           
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    public function removePergunta($id){
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
}

