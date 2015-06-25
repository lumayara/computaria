<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TestDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/ParticipantDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/TestParticipant.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Classification.class.php';

class TestParticipantDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(TestParticipant $testParticipant) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Test_Participant (participant_id, test_id, finalized, start_time, end_time) "
                    . "VALUES (:participant_id, :test_id, :finalized, start_time = :start_time, end_time = :end_time)");

            $properties = array($testParticipant->getParticipant()->getId(), $testParticipant->getTest()->getId(),
                $testParticipant->getFinalized(), $testParticipant->getStartTime(),
                $testParticipant->getEndTime());

            $stmt->bindParam(":participant_id", $properties[0]);
            $stmt->bindParam(":test_id", $properties[1]);
            $stmt->bindParam(":finalized", $properties[2]);
            $stmt->bindParam(":start_time", $properties[3]);
            $stmt->bindParam(":end_time", $properties[4]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(TestParticipant $testParticipant) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Test_Participant SET participant_id = :participant_id, "
                    . "test_id = :test_id, finalized = :finalized, start_time = :start_time, end_time = :end_time WHERE id = :id");

            $properties = array($testParticipant->getParticipant()->getId(), $testParticipant->getTest()->getId(),
                $testParticipant->getFinalized(), $testParticipant->getStartTime(),
                $testParticipant->getEndTime(), $testParticipant->getId());

            $stmt->bindParam(":participant_id", $properties[0]);
            $stmt->bindParam(":test_id", $properties[1]);
            $stmt->bindParam(":finalized", $properties[2]);
            $stmt->bindParam(":start_time", $properties[3]);
            $stmt->bindParam(":end_time", $properties[4]);
            $stmt->bindParam(":id", $properties[5]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Test_Participant WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT participant_id, test_id, finalized, start_time, end_time FROM Test_Participant WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $testDAO = new TestDAO();
        $participantDAO = new ParticipantDAO();
        if ($result) {
            return new TestParticipant($id, $participantDAO->get($result['participant_id']), $testDAO->get($result['test_id']), $result['finalized'], $result['start_time'], $result['end_time']);
        } else {
            return FALSE;
        }
    }

    public function listTestsParticipant($participantId) {
        try {
            $stmt = $this->conexao->prepare("SELECT * FROM Test_Participant WHERE participant_id = :participantId ORDER BY id DESC");
            $stmt->bindParam(":participantId", $participantId);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $testsParticipant = array();
        $testDAO = new TestDAO();
        $participantDAO = new ParticipantDAO();
        for ($i = 0; $i < count($result); $i++) {
            $testsParticipant[$i] = new TestParticipant($result[$i]['id'], $participantDAO->get($result[$i]['participant_id']), $testDAO->get($result[$i]['test_id']), $result[$i]['finalized'], $result[$i]['start_time'], $result[$i]['end_time']);
        }
        return $testsParticipant;
    }

    public function getRanking($id) {
        $ranking = array();
        try {
            $stmt = $this->conexao->prepare("SELECT DISTINCT p.*, tp.*, TIMEDIFF(tp.end_time, tp.start_time) completion_time, IFNULL(SUM(q.points), 0) points, COUNT(a.id) answered, COUNT(c.its_answer) rights 
                                            FROM Participant p, Test_Participant tp
                                            LEFT OUTER JOIN Answers a ON (
                                                tp.id = a.test_participant_id
                                            )
                                            LEFT OUTER JOIN Choice c ON (
                                                a.choice_id = c.id AND
                                                c.its_answer = true 
                                            )
                                            LEFT OUTER JOIN Question q ON (
                                                a.question_id = q.id AND
                                                c.question_id = q.id
                                            )
                                            WHERE 
                                            tp.participant_id = p.id AND 
                                            tp.test_id = 19 
                                            GROUP BY tp.id ORDER BY points DESC, rights DESC, answered DESC, completion_time ASC, p.name ASC");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($result); $i++) {
            $participant = new Participant($result[$i]['id'], $result[$i]['name'], $result[$i]['email'], $result[$i]['password'], $result[$i]['team'], NULL);
            $testParticipant = new TestParticipant($result[$i]['id'], $participant, NULL, $result[$i]['finalized'], $result[$i]['start_time'], $result[$i]['end_time']);
            $classification = new Classification($testParticipant, $result[$i]['completion_time'], $result[$i]['points'], $result[$i]['answered'], $result[$i]['rights']);
            $ranking[$i] = $classification;
        }
        return $ranking;
    }

}
