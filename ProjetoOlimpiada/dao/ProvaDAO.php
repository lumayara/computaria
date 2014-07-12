<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProvaDAO
 *
 * @author Luana
 */
include_once '../conexao/ConnectionFactory.php';
include_once '../modelo/Prova.php';
class ProvaDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addProva(Prova $prova) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO TEST (nivel, id_competicao)"
                    . "VALUES (:nivel, :id_competicao)");
            $vetorUser = array($prova->getNivel(), $prova->getCompeticao());
            
            $stmt->bindParam(":nivel", $vetorUser[0]);
            $stmt->bindParam(":id_competicao", $vetorUser[1]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updateProva(Prova $prova){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE TEST SET nivel = :nivel, "
                    . "id_competicao = :id_competicao WHERE nivel = :nivel");
            
            $vetorUser = array($prova->getNivel(), $prova->getCompeticao());
            
            $stmt->bindParam(":nivel", $vetorUser[0]);
            $stmt->bindParam(":id_competicao", $vetorUser[1]);
           
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    public function removeProva($nivel){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM TEST WHERE nivel = :nivel");
            $stmt->bindParam(":nivel", $nivel);
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
