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
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/dao/TestParticipantDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/dao/QuestionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/dao/ChoiceDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Answers.class.php'; //Essa tem q esperar

class AnswersDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Answers $answers) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Answers (test_participant_id, question_id, choice_id) "
                    . "VALUES (:test_participant_id, :question_id, :choice_id)");

            $properties = array($answers->getTestParticipant()->getId(), $answers->getQuestion()->getId(), $answers->getChoice()->getId());

            $stmt->bindParam(":test_participant_id", $properties[0]);
            $stmt->bindParam(":question_id", $properties[1]);
            $stmt->bindParam(":choice_id", $properties[2]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Answers $answers) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Answers SET classification = :classification, "
                    . "competition_id = :competition_id WHERE id = :id");

            $properties = array($answers->getTestParticipant()->getId(), $answers->getQuestion()->getId(), $answers->getChoice()->getId(), $answers->getId());

            $stmt->bindParam(":test_participant_id", $properties[0]);
            $stmt->bindParam(":question_id", $properties[1]);
            $stmt->bindParam(":choice_id", $properties[2]);
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
            $stmt = $this->conexao->prepare("DELETE FROM Answers WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT test_participant_id, question_id, choice_id FROM Answers WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $testParticipantDAO = new TestParticipantDAO();
        $questionDAO = new QuestionDAO();
        $choiceDAO = new ChoiceDAO();
        if ($result) {
            return new Answers($id, $testParticipantDAO->get($result['test_participant_id']), $questionDAO->get($result['question_id']), $choiceDAO->get($result['choice_id']));
        } else {
            return FALSE;
        }
    }

    public function listAnswers() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, test_participant_id, question_id, choice_id FROM Answers ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $answers = array();
        $testParticipantDAO = new TestParticipantDAO();
        $questionDAO = new QuestionDAO();
        $choiceDAO = new ChoiceDAO();
        for ($i = 0; $i < count($result); $i++) {
            $answers[$i] = new Answers($result[$i]['id'], $testParticipantDAO->get($result[$i]['test_participant_id']), $questionDAO->get($result[$i]['question_id']), $choiceDAO->get($result[$i]['choice_id']));
        }
        return $answers;
    }

}
