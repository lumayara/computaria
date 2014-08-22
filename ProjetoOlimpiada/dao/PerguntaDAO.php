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
    
    public function addPergunta(Pergunta $pergunta) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO QUESTIONS (id, data_cadastro, pergunta,"
                    . "topico, id_competicao) VALUES (:id, :data_cadastro, :pergunta, :topico, :id_competicao)");

            $vetorUser = array($pergunta->getId(), $pergunta->getDataCadastro(), $pergunta->getPergunta(),
                $pergunta->getTopico(), $pergunta->getCompeticao());
            
            $stmt->bindParam(":id", $vetorUser[0]);
            $stmt->bindParam(":data_cadastro", $vetorUser[1]);
            $stmt->bindParam(":pergunta", $vetorUser[2]);
            $stmt->bindParam(":topico", $vetorUser[3]);
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
        
    public function getPergunta($id){
        try {
            $stmt = $this->conexao->prepare("SELECT pergunta, topico, id_competicao FROM QUESTIONS WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
        
   public function updatePergunta(Pergunta $pergunta){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE QUESTIONS SET pergunta = :pergunta, "
                    . "topico = :topico WHERE id = :id");
            
            $vetorUser = array($pergunta->getPergunta(), $pergunta->getTopico(), $pergunta->getId());
            
            $stmt->bindParam(":pergunta", $vetorUser[0]);
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
    
    public function listarQuestoes() {
            try{
        $stmt = $this->conexao->prepare("SELECT id, topico, pergunta, data_cadastro FROM QUESTIONS ORDER BY id DESC");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function listarQuestoesByCompeticao($id_competicao) {
            try{
        $stmt = $this->conexao->prepare("SELECT id, topico, pergunta, data_cadastro FROM QUESTIONS WHERE id_competicao= :id_competicao ORDER BY id DESC");
        $stmt->bindParam(":id_competicao", $id_competicao);
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
}

