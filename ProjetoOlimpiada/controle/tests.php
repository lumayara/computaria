<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/CompetitionDAO.php";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/TestParticipantDAO.php";
include_once "$url_path/dao/AnswersDAO.php";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/QuestionDAO.php";
include_once "$url_path/dao/ChoiceDAO.php";

$competitionDAO = new CompetitionDAO();
$participantDAO = new ParticipantDAO();
$testParticipantDAO = new TestParticipantDAO();
$answersDAO = new AnswersDAO();
$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();
$choiceDAO = new ChoiceDAO();

/* for ($i = 0; $i < 15; $i++) {
  $date = new DateTime();
  $questionId = $questionDAO->add(new Question(NULL, $date->format('Y-m-d H:i:s'), " oi oi ".$i."?", "comunicacao", 1.5, $testDAO->get(19)));
  for ($j = 0; $j < 5; $j++) {
  $choiceDAO->add(new Choice(NULL, "Opção " . $j, ($j == 0 ? TRUE : FALSE), $questionDAO->get($questionId)));
  }
  } */

$user = new Participant(NULL, "User", "user@email.com", "123", "1", $competitionDAO->get(11));

$user->setId($participantDAO->add($user));

if ($user->getId() != 0) {
    echo "Usuário Adicionado <br />";
    for ($i = 0; $i < count($test); $i++) {
        $testParticipant = new TestParticipant($id, $user, $testDAO->get($test[$i]), false, NULL, NULL);
        $testParticipantDAO->add($testParticipant);
    }
    echo "Usuário Adicionado <br />";
    // header("Location: listUser.php");
} else {
    echo "Usuário não Adicionado <br />";
}
