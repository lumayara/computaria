<?php

/**
 * Description of competition
 *
 * @author Luana
 */

class Competition {
    private $id;
    private $name;
    private $startDate;
                
    function __construct($id, $name, $startDate) {
        $this->id = $id;
        $this->name = $name;
        $this->startDate= $startDate;
    }
    
    public function getName() {
        return $this->name;
    }
   
    public function getId() {
        return $this->id;
    }
  
    public function setName($name) {
        $this->name = $name;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
     public function getStartDate() {
        return $this->startDate;
    }
  
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
    
}
