<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/TestParticipantDAO.php";
include_once "$url_path/dao/AnswersDAO.php";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/QuestionDAO.php";
include_once "$url_path/dao/ChoiceDAO.php";

$userDAO = new ParticipantDAO();
$testParticipantDAO = new TestParticipantDAO();
$answersDAO = new AnswersDAO();
$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();
$choiceDAO = new ChoiceDAO();

for ($i = 0; $i < 15; $i++) {
    $date = new DateTime();
    $questionId = $questionDAO->add(new Question(NULL, $date->format('Y-m-d H:i:s'), " oi oi ".$i."?", "comunicacao", 1.5, $testDAO->get(19)));
    for ($j = 0; $j < 5; $j++) {
        $choiceDAO->add(new Choice(NULL, "Opção " . $j, ($j == 0 ? TRUE : FALSE), $questionDAO->get($questionId)));
    }
}
