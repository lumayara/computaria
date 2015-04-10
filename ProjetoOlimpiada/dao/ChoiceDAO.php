<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ChoiceDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Choice.class.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/QuestionDAO.php';

class ChoiceDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Choice $choice) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Choice (choice, its_answer, question_id) "
                    . "VALUES (:choice, :its_answer, :question_id)");

            $properties = array($choice->getChoice(), $choice->getItsAnswer(),
                $choice->getQuestion()->getId());

            $stmt->bindParam(":choice", $properties[0]);
            $stmt->bindParam(":its_answer", $properties[1]);
            $stmt->bindParam(":question_id", $properties[2]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Choice $choice) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Choice SET choice = :choice, "
                    . "its_answer = :its_answer, question_id = :question_id "
                    . "WHERE id = :id");

            $properties = array($choice->getChoice(), $choice->getItsAnswer(),
                $choice->getQuestion()->getId(), $choice->getId());

            $stmt->bindParam(":choice", $properties[0]);
            $stmt->bindParam(":its_answer", $properties[1]);
            $stmt->bindParam(":question_id", $properties[2]);
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
            $stmt = $this->conexao->prepare("DELETE FROM Choice WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT choice, its_answer, question_id FROM Choice WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $questionDAO = new QuestionDAO();
        if ($result) {
            return new Choice($id, $result['choice'], $result['its_answer'], $questionDAO->get($result['question_id']));
        } else {
            return FALSE;
        }
    }

    public function listChoices() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, choice, its_answer, question_id FROM Choice ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $choices = array();
        $questionDAO = new QuestionDAO();
        for ($i = 0; $i < count($result); $i++) {
            $choices[$i] = new Choice($result[$i]['id'], $result[$i]['choice'], $result[$i]['its_answer'], $questionDAO->get($result[$i]['question_id']));
        }
        return $choices;
    }

    public function listChoicesByQuestion($questionId) {
        try {
            $stmt = $this->conexao->prepare("SELECT id, choice, its_answer FROM CHOICE WHERE question_id = :question_id ORDER BY id DESC");
            $stmt->bindParam(":question_id", $questionId);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $choices = array();
        $questionDAO = new QuestionDAO();
        for ($i = 0; $i < count($result); $i++) {
            $choices[$i] = new Choice($result[$i]['id'], $result[$i]['choice'], 
                    $result[$i]['its_answer'], $questionDAO->get($questionId)->getId());
        }
        return $choices;
    }

}
