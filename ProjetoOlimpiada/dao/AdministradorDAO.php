<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AdministradorDAO
 *
 * @author Luana
 */
require_once '../conexao/ConnectionFactory.php';
require_once '../modelo/Administrador.php';
class AdministradorDAO {
     private $conexao;
    
    public function __construct() {
        $this->conexao = ConnectionFactory::getInstance();
    }
    
    public function addAdministrador(Administrador $admin) {
        $adicionado = false;
        try {
            $stmt = $this->conexao->prepare("INSERT INTO ADMINISTRATOR (email, senha)"
                    . "VALUES (:email, :senha)");
            $vetorUser = array($admin->getEmail(), $admin->getSenha());
            
            $stmt->bindParam(":email", $vetorUser[0]);
            $stmt->bindParam(":senha", $vetorUser[1]);
            
            $resultado = $stmt->execute();
            if($resultado){
                $adicionado = TRUE;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $adicionado;
        }
        
   public function updateAdm(Administrador $admin){
        $atualizado=FALSE;
        try{
            $stmt = $this->conexao->prepare("UPDATE ADMINISTRATOR SET email = :email, "
                    . "senha = :senha WHERE id = :id");
            
            $vetorUser = array($admin->getEmail(), $admin->getSenha(), $admin->getID());
            
            $stmt->bindParam(":email", $vetorUser[0]);
            $stmt->bindParam(":senha", $vetorUser[1]);
            $stmt->bindParam(":id", $vetorUser[2]);
           
            $resultado = $stmt->execute();
            if($resultado){
                $atualizado = TRUE;
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return $atualizado;
    }
    
    public function removeAdm($id){
        $removido = false;
        try {
            $stmt = $this->conexao->prepare("DELETE FROM ADMINISTRATOR WHERE id = :id");
            $stmt->bindParam(":id", $id);
            $resultado = $stmt->execute();
            if($resultado){
                $removido = true;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $removido;
    }     
    
    public function validaUsuario($email, $senha) {
        try{
            $stmt = $this->conexao->prepare("SELECT id FROM ADMINISTRATOR WHERE email =:email and senha =:senha");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":senha", $senha);
            
            $stmt->execute();
                       
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $stmt->fetch(PDO::FETCH_COLUMN);    
    }
}
