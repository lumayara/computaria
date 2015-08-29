<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/modelo/Test.class.php';

/**
 * Description of Question
 *
 * @author Luana
 */
class Question{
    
    private $id;
    private $registrationDate;
    private $question;
    private $topic;
    private $test;
    private $points;
    private $imagem;
    
    function __construct($id, $registrationDate, $question, $topic, $points, $imagem, $test) {
        $this->id = $id;
        $this->registrationDate = $registrationDate;
        $this->question = $question;
        $this->topic = $topic;
        $this->points = $points;
        $this->imagem = $imagem;
        $this->test = $test;
        
    }

    public function getId() {
        return $this->id;
    }

    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getTopic() {
        return $this->topic;
    }
    
    public function getPoints() {
        return $this->points;
    }

    public function getTest() {
        return $this->test;
    }
    
    public function getImagem() {
        return $this->imagem;
    }

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }

    public function setQuestion($question) {
        $this->question = $question;
    }

    public function setTopic($topic) {
        $this->topic = $topic;
    }

     public function setPoints($points) {
        $this->points = $points;
    }
    
    public function setTest($test) {
        $this->test = $test;
    }
    
}
