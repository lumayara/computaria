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

class TestParticipantDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(TestParticipant $testParticipant) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Test_Participant (participant_id, test_id, finalized) "
                    . "VALUES (:participant_id, :test_id, :finalized)");

            $properties = array($testParticipant->getParticipant()->getId(), $testParticipant->getTest()->getId(), $testParticipant->getFinalized());

            $stmt->bindParam(":participant_id", $properties[0]);
            $stmt->bindParam(":test_id", $properties[1]);
            $stmt->bindParam(":finalized", $properties[2]);

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
                    . "test_id = :test_id, finalized = :finalized WHERE id = :id");

            $properties = array($testParticipant->getParticipant()->getId(), $testParticipant->getTest()->getId(), $testParticipant->getFinalized(), $testParticipant->getId());

            $stmt->bindParam(":participant_id", $properties[0]);
            $stmt->bindParam(":test_id", $properties[1]);
            $stmt->bindParam(":finalized", $properties[2]);
            $stmt->bindParam(":id", $properties[3]);

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
            $stmt = $this->conexao->prepare("SELECT participant_id, test_id, finalized FROM Test_Participant WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $testDAO = new TestDAO();
        $participantDAO = new ParticipantDAO();
        if ($result) {
            return new TestParticipant($id, $participantDAO->get($result['participant_id']), $testDAO->get($result['test_id']), $result['finalized']);
        } else {
            return FALSE;
        }
    }

    public function listTestsParticipant() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, participant_id, test_id, finalized FROM Test_Participant ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $testsParticipant = array();
        $testDAO = new TestDAO();
        $participantDAO = new ParticipantDAO();
        for ($i = 0; $i < count($result); $i++) {
            $testsParticipant[$i] = new TestParticipant($result[$i]['id'], $participantDAO->get($result[$i]['participant_id']), $testDAO->get($result[$i]['test_id']), $result[$i]['finalized']);
        }
        return $testsParticipant;
    }

}
