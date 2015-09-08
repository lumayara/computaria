<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministratorDAO
 *
 * @author Luana
 */
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/conexao/ConnectionFactory.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/comp/ProjetoOlimpiada/modelo/Administrator.class.php';

class AdministratorDAO {

    private $conexao;

    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }

    public function add(Administrator $admin) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO Administrator (email, password) "
                    . "VALUES (:email, :password)");

            $properties = array($admin->getEmail(), $admin->getPassword());

            $stmt->bindParam(":email", $properties[0]);
            $stmt->bindParam(":password", $properties[1]);

            $resultado = $stmt->execute();

            if ($resultado) {
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
    }

    public function update(Administrator $admin) {
        $atualizado = FALSE;
        try {
            $stmt = $this->conexao->prepare("UPDATE Administrator SET email = :email, "
                    . "password = :password WHERE id = :id");

            $properties = array($admin->getEmail(), $admin->getPassword(), $admin->getId());

            $stmt->bindParam(":email", $properties[0]);
            $stmt->bindParam(":password", $properties[1]);
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
            $stmt = $this->conexao->prepare("DELETE FROM Administrator WHERE id = :id");
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
            $stmt = $this->conexao->prepare("SELECT email FROM Administrator WHERE id = :id");
            $stmt->bindParam(":id", $id);
            
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Administrator($id, $result['email'], NULL);
        } else {
            return FALSE;
        }
    }
    
    public function listAdmins() {
        try {
            $stmt = $this->conexao->prepare("SELECT email, id FROM Administrator ORDER BY id DESC");

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $admins = array();
        for ($i = 0; $i < count($result); $i++) {
            $admins[$i] = new Administrator($result[$i]['id'], $result[$i]['email'], NULL);
        }
        return $admins;
    }

    public function userValidate($email, $password) {
        try {
            $stmt = $this->conexao->prepare("SELECT id FROM Administrator WHERE email = :email and password = :password");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":password", $password);

            $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Administrator($result['id'], $email, NULL);
        } else {
            return FALSE;
        }
    }

}
