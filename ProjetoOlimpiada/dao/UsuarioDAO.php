<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ParticipantDAO
 *
 * @author Luana
 */
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/conexao/ConnectionFactory.php";
include_once "$url_path/modelo/Participant.class.php";
class ParticipantDAO {
    private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addParticipant(Participant $participant) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO PARTICIPANT (name, email, password, team, competition_id)"
                    . "VALUES (:name, :email, :password, :team, :competition_id)");
            $vetorUser = array($participant->getNome(), $participant->getEmail(), $participant->getSenha(), $participant->getTurma(), $participant->getCompetition());
            
            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":team", $vetorUser[3]);
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


    public function listarParticipantes() {
            try{
        $stmt = $this->conexao->prepare("SELECT P.name, P.team, P.email, C.name AS competition, P.id FROM PARTICIPANT P, COMPETITION C WHERE C.id=P.competition_id");
        
        $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
            
    }
    
    public function getParticipant($id){
        try {
            $stmt = $this->conexao->prepare("SELECT name, email, team, password, competition_id FROM PARTICIPANT WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        }catch (PDOException $e){
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
        
   public function updateParticipant(Participant $participant){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE PARTICIPANT SET name = :name, email = :email, "
                    . "password = :password, team = :team, competition_id = :competition_id WHERE id= :id");
            
            $vetorUser = array($participant->getNome(),$participant->getEmail(), $participant->getSenha(),
                 $participant->getTurma(), $participant->getCompetition(), $participant->getID());
            
            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":team", $vetorUser[3]);
            $stmt->bindParam(":competition_id", $vetorUser[4]);
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
    
    public function removeParticipant($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM PARTICIPANT WHERE id = :id");
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
    
     public function validaParticipant($email, $password) {
        try{
            $stmt = $this->conexao->prepare("SELECT id FROM PARTICIPANT WHERE email =:email and password =:password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);
            
            $stmt->execute();
                       
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_COLUMN);    
    }
    
    public function addRespostas($id_user, $id_Choice) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO PARTICIPANT_ANSWERS (id_user, id_Choice) VALUES (:id_user, :id_Choice)");
           
            $stmt->bindParam(":id_user", $id_user);
            $stmt->bindParam(":id_Choice", $id_Choice);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
    
}