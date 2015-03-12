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
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/CompetitionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Test.class.php';

class TestDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Test $test) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Test (classification, competition_id) "
                    . "VALUES (:classification, :competition_id)");

            $properties = array($test->getClassification(), $test->getCompetition()->getId());

            $stmt->bindParam(":classification", $properties[0]);
            $stmt->bindParam(":competition_id", $properties[1]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Test $test) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Test SET classification = :classification, "
                    . "competition_id = :competition_id WHERE id = :id");

            $properties = array($test->getClassification(), $test->getCompetition()->getId(), $test->getId());

            $stmt->bindParam(":classification", $properties[0]);
            $stmt->bindParam(":competition_id", $properties[1]);
            $stmt->bindParam(":id", $properties[2]);

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
            $stmt = $this->conexao->prepare("DELETE FROM Test WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT id, classification, competition_id FROM Test WHERE id = :id");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $competitionDAO = new CompetitionDAO();
        if ($result) {
            return new Test($result['id'], $result['classification'], $competitionDAO->get($result['competition_id']));
        } else {
            return FALSE;
        }
    }

    public function listTests() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, classification, competition_id FROM Test ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $tests = array();
        $competitionDAO = new CompetitionDAO();
        for ($i = 0; $i < count($result); $i++) {
            $tests[$i] = new Test($result[$i]['id'], $result[$i]['classification'], $competitionDAO->get($result[$i]['competition_id']));
        }
        return $tests;
    }

}
