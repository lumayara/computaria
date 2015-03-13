<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of QuestionDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/QuestionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Question.class.php';

class QuestionDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Question $question) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Question (registration_date, question, topic, test_id) "
                    . "VALUES (:registration_date, :question, :topic, :test_id)");

            $properties = array($question->getRegistrationDate(), $question->getQuestion(), 
                                $question->getTopic(), $question->getTest()->getId());

            $stmt->bindParam(":registration_date", $properties[0]);
            $stmt->bindParam(":question", $properties[1]);
            $stmt->bindParam(":topic", $properties[2]);
            $stmt->bindParam(":test_id", $properties[3]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Question $question) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Question SET registration_date = :registration_date, "
                                            . "question = :question, topic = :topic, test_id = :test_id "
                                            . "WHERE id = :id");

            $properties = array($question->getRegistrationDate(), $question->getQuestion(), 
                                $question->getTopic(), $question->getTest()->getId());

            $stmt->bindParam(":registration_date", $properties[0]);
            $stmt->bindParam(":question", $properties[1]);
            $stmt->bindParam(":topic", $properties[2]);
            $stmt->bindParam(":test_id", $properties[3]);
            $stmt->bindParam(":id", $properties[4]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Question WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT registration_date, question, topic, test_id FROM Question WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $testDAO = new TestDAO();
        if ($result) {
            return new Question($id, $result['registration_date'], $result['question'], 
                                $result['topic'], $testDAO->get($result['test_id']));
        } else {
            return FALSE;
        }
    }

    public function listQuestions() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, registration_date, question, topic, test_id FROM Question ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $questions = array();
        $testDAO = new TestDAO();
        for ($i = 0; $i < count($result); $i++) {
            $questions[$i] = new Question($result[$i]['id'], $result[$i]['registration_date'], $result[$i]['question'], 
                                $result[$i]['topic'], $testDAO->get($result[$i]['test_id']));
                                
        }
        return $questions;
    }

}
