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
            $stmt = $this->conexao->prepare("INSERT INTO Test (classification, start_date, end_date, competition_id) "
                    . "VALUES (:classification, :start_date, :end_date, :competition_id)");

            $properties = array($test->getClassification(), $test->getCompetition()->getId());

            $stmt->bindParam(":classification", $properties[0]);
            $stmt->bindParam(":start_date", $properties[1]);
            $stmt->bindParam(":end_date", $properties[2]);
            $stmt->bindParam(":competition_id", $properties[3]);

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
                    . "start_date = :start_date, end_date = :end_date"
                    . "competition_id = :competition_id WHERE id = :id");

            $properties = array($test->getClassification(), $test->getCompetition()->getId(), $test->getId());

            $stmt->bindParam(":classification", $properties[0]);
            $stmt->bindParam(":start_date", $properties[1]);
            $stmt->bindParam(":end_date", $properties[2]);
            $stmt->bindParam(":competition_id", $properties[3]);
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
            $stmt = $this->conexao->prepare("SELECT classification, start_date, end_date, competition_id FROM Test WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $competitionDAO = new CompetitionDAO();
        if ($result) {
            return new Test($id, $result['classification'], $result['start_date'], 
                    $result['end_date'], $competitionDAO->get($result['competition_id']));
        } else {
            return FALSE;
        }
    }

    public function listTests() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, classification, start_date, end_date, competition_id FROM Test ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $tests = array();
        $competitionDAO = new CompetitionDAO();
        for ($i = 0; $i < count($result); $i++) {
            $tests[$i] = new Test($result[$i]['id'], $result[$i]['classification'], 
                    $result[$i]['start_date'], $result[$i]['end_date'], $competitionDAO->get($result[$i]['competition_id']));
        }
        return $tests;
    }

}
