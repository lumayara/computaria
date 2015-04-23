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
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/CompetitionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Participant.class.php';

class ParticipantDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Participant $participant) {
        $adicionado = 0;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO PARTICIPANT (name, email, password, team, competition_id)"
                    . "VALUES (:name, :email, :password, :team, :competition_id)");
            $vetorUser = array($participant->getName(), $participant->getEmail(),
                $participant->getPassword(), $participant->getTeam(),
                $participant->getCompetition()->getId());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":team", $vetorUser[3]);
            $stmt->bindParam(":competition_id", $vetorUser[4]);

            $resultado = $stmt->execute();
            
            if ($resultado) {                
                $adicionado = $this->conexao->lastInsertId();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Participant $participant) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Participant SET name = :name, "
                    . "email = :email, password = :password, "
                    . "team = :team, competition_id = :competition_id "
                    . "WHERE id = :id");

            $vetorUser = array($participant->getName(), $participant->getEmail(),
                $participant->getPassword(), $participant->getTeam(),
                $participant->getCompetition()->getId(), $participant->getId());

            $stmt->bindParam(":name", $vetorUser[0]);
            $stmt->bindParam(":email", $vetorUser[1]);
            $stmt->bindParam(":password", $vetorUser[2]);
            $stmt->bindParam(":team", $vetorUser[3]);
            $stmt->bindParam(":competition_id", $vetorUser[4]);
            $stmt->bindParam(":id", $vetorUser[5]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $atualizado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $atualizado;
    }

    public function remove($id) {
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM Participant WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $resultado = $stmt->execute();

            if ($resultado) {
                $removido = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $removido;
    }

    public function get($id) {
        try {
            $stmt = $this->conexao->prepare("SELECT name, email, password, team, competition_id FROM Participant WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $competitionDAO = new CompetitionDAO();
        if ($result) {
            return new Participant($id, $result['name'], $result['email'], $result['password'], $result['team'], $competitionDAO->get($result['competition_id']));
        } else {
            return FALSE;
        }
    }
    
    public function listParticipants() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, email, password, team, competition_id FROM Participant ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $participants = array();
        $competitionDAO = new CompetitionDAO();
        for ($i = 0; $i < count($result); $i++) {
            $participants[$i] = new Participant($result[$i]['id'], $result[$i]['name'], $result[$i]['email'], $result[$i]['password'], $result[$i]['team'], $competitionDAO->get($result[$i]['competition_id']));
                                
        }
        return $participants;
    }

    public function participantValidation($email, $password) {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, team, competition_id FROM Participant WHERE email = :email and password = :password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $competitionDAO = new CompetitionDAO();
        if ($result) {
            return new Participant($result['id'], $result['name'], $email, $password, $result['team'], $competitionDAO->get($result['competition_id']));
        } else {
            return FALSE;
        }
    }

//    public function addRespostas($id_user, $id_Choice) {
//        $adicionado = false;
//        try {
//            $stmt = $this->conexao->prepare("INSERT INTO PARTICIPANT_ANSWERS (id_user, id_Choice) VALUES (:id_user, :id_Choice)");
//
//            $stmt->bindParam(":id_user", $id_user);
//            $stmt->bindParam(":id_Choice", $id_Choice);
//
//            $resultado = $stmt->execute();
//            if ($resultado) {
//                $adicionado = TRUE;
//            }
//        } catch (PDOException $e) {
//            echo $e->getMessage();
//        }
//        return $adicionado; 
//    }

}
