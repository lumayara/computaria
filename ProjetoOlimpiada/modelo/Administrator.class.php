<?php

/**
 * Description of Administrador
 *
 * @author Luana
 */
class Administrator{
    
    private $id;
    private $email;
    private $password;

    
    function __construct($id, $email, $password) {
        $this->id = $id;
        $this->email = $email;
        $this->senha = $password;              
    }
    
    public function getID() {
        return $this->id;
    }
 
    public function getEmail() {
        return $this->email;
    }
    
    public function getPassword() {
        return $this->senha;
    }
    
    public function setID($id) {
        $this->id = $id;
    }
 
    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setPassword($password){
        $this->senha = $password;
    }
    
}
