<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompetitionDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Competition.class.php';

class CompetitionDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Competition $competition) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Competition (name, start_date) "
                    . "VALUES (:name, :start_date)");

            $properties = array($competition->getName(), $competition->getStartDate());

            $stmt->bindParam(":name", $properties[0]);
            $stmt->bindParam(":start_date", $properties[1]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Competition $competition) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Competition SET name = :name, "
                    . "start_date = :start_date WHERE id = :id");

            $properties = array($competition->getName(), $competition->getStartDate(), $competition->getId());

            $stmt->bindParam(":name", $properties[0]);
            $stmt->bindParam(":start_date", $properties[1]);
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
            $stmt = $this->conexao->prepare("DELETE FROM Competition WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT name, start_date FROM Competition WHERE id = :id");
            $stmt->bindParam(":id", $id);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        if ($result) {
            return new Competition($result['id'], $result['name'], $result['start_date']);
        } else {
            return FALSE;
        }
    }

    public function listCompetitions() {
        try {
            $stmt = $this->conexao->prepare("SELECT id, name, start_date FROM Competition ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $competitions = array();
        for ($i = 0; $i < count($result); $i++) {
            $competitions[$i] = new Competition($result[$i]['id'], $result[$i]['name'], $result[$i]['start_date']);
        }
        return $competitions;
    }

}
