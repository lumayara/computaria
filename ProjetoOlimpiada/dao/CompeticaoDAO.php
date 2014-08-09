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
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/conexao/ConnectionFactory.php";
include_once "$url_path/modelo/Competicao.php";
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
            $stmt = $this->conexao->prepare("UPDATE COMPETITION SET nome = :nome, data_realizacao = :data_realizacao WHERE id= :id");
            
            $vetorUser = array($comp->getNome(),$comp->getData(), $comp->getId());
           
            $stmt->bindParam(":nome", $vetorUser[0]);
            $stmt->bindParam(":data_realizacao", $vetorUser[1]);
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
    
    public function listarCompeticoes() {
            try{
        $stmt = $this->conexao->prepare("SELECT nome, data_realizacao, id FROM COMPETITION ORDER BY id DESC");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function getCompeticao($id){
        try {
            $stmt = $this->conexao->prepare("SELECT nome, data_realizacao FROM COMPETITION WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
