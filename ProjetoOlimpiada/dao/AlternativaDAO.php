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
include_once '../conexao/ConnectionFactory.php';
include_once '../modelo/Alternativa.php';
class AlternativaDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addAlternativa(Alternativa $alternativa, $id_pergunta) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO CHOICES (alternativa, eh_resposta, id_question)"
                    . "VALUES (:alternativa, :eh_resposta, :id_question)");
            $vetorUser = array($alternativa->getAlternativa(), $alternativa->getEh_certa());
            
            $stmt->bindParam(":alternativa", $vetorUser[0]);
            $stmt->bindParam(":eh_resposta", $vetorUser[1]);
            $stmt->bindParam(":id_question", $id_pergunta);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updateAlternativa(Alternativa $alternativa){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE CHOICES SET alternativa = :alternativa, "
                    . "eh_resposta = :eh_resposta WHERE id = :id");
            
            $vetorUser = array($alternativa->getAlternativa(), $alternativa->getEh_certa(), $alternativa->getID());
            
            $stmt->bindParam(":alternativa", $vetorUser[0]);
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
    
     public function getAlternativa($id){
        try {
            $stmt = $this->conexao->prepare("SELECT alternativa, eh_resposta, id_question FROM CHOICES WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function removeAlternativa($id){
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
    
    public function listarAlternativas() {
            try{
        $stmt = $this->conexao->prepare("SELECT id, alternativa, eh_resposta FROM CHOICES ORDER BY id DESC");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function listarAlternativasByQuestao($id_question) {
            try{
        $stmt = $this->conexao->prepare("SELECT id, alternativa, eh_resposta FROM CHOICES WHERE id_question= :id_question ORDER BY id DESC");
        $stmt->bindParam(":id_question", $id_question);
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
}
