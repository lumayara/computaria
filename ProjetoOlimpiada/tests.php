<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/AdministratorDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/CompetitionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/QuestionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/ChoiceDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/ParticipantDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestParticipantDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/AnswersDAO.php';

$adminDAO = new AdministratorDAO();
$cDAO = new CompetitionDAO();
$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();
$choiceDAO = new ChoiceDAO();
$participantDAO = new ParticipantDAO();
$testParticipantDAO = new TestParticipantDAO();
$answersDAO = new AnswersDAO();

//echo "=== Administrator ===";
//echo "<br />";
//echo "= Add Administrator =";
//echo "<br />";
//echo var_dump($adminDAO->add(new Administrator(NULL, "email@email.com", "123")));
//echo "<br />";
//echo var_dump($adminDAO->add(new Administrator(NULL, "email2@email.com", "123")));
//echo "<br />";
//echo "= Get Administrator =";
//echo "<br />";
//echo var_dump($adminDAO->get(2));
//echo "<br />";
//echo "= Update Administrator =";
//echo "<br />";
//echo var_dump($adminDAO->update(new Administrator(1, "email3@email.com", "123")));
//echo "<br />";
//echo "= List Administrators =";
//echo "<br />";
//echo var_dump($adminDAO->listAdmins());
//echo "<br />";
//echo "= Remove Administrator =";
//echo "<br />";
//echo var_dump($adminDAO->remove(1));
//echo "<br />";
//echo "= Validate Administrator =";
//echo "<br />";
//echo var_dump($adminDAO->userValidate("email3@email.com", "123"));
//echo "<br />";
//echo var_dump($adminDAO->userValidate("email2@email.com", "123"));
//echo "<br />";
//echo "<br />";
//
//echo "=== Competition ===";
//echo "<br />";
//echo "= Add Competition =";
//echo "<br />";
//echo var_dump($cDAO->add(new Competition(NULL, "Competição 1", NULL)));
//echo "<br />";
//echo var_dump($cDAO->add(new Competition(NULL, "Competição 2", NULL)));
//echo "<br />";
//echo "= Get Competition =";
//echo "<br />";
//echo var_dump($cDAO->get(1));
//echo "<br />";
//echo "= Update Competition =";
//echo "<br />";
//echo var_dump($cDAO->update(new Competition(1, "Competição 2", "2015-03-11 22:08:26")));
//echo "<br />";
//echo "= List Competitions =";
//echo "<br />";
//echo var_dump($cDAO->listCompetitions());
//echo "<br />";
//echo "= Remove Competition =";
//echo "<br />";
//echo var_dump($cDAO->remove(1));
//echo "<br />";
//echo "<br />";

//echo "=== Test ===";
//echo "<br />";
//echo "= Add Test =";
//echo "<br />";
//echo var_dump($choiceDAO->add(new Test(NULL, "medio", $cDAO->get(2))));
//echo "<br />";
//echo var_dump($choiceDAO->add(new Test(NULL, "superior", $cDAO->get(2))));
//echo "<br />";
//echo "= Get Test =";
//echo "<br />";
//echo var_dump($choiceDAO->get(2));
//echo "<br />";
//echo "= Update Test =";
//echo "<br />";
//echo var_dump($choiceDAO->update(new Test(1, "superior", $cDAO->get(2))));
//echo "<br />";
//echo "= List Tests =";
//echo "<br />";
//echo var_dump($choiceDAO->listTests());
//echo "<br />";
//echo "= Remove Test =";
//echo "<br />";
//echo var_dump($choiceDAO->remove(1));
//echo "<br />";
//echo "<br />";

//Testcenario
//$comp = $compDAO->get(2);
//
//echo "=== Test ===";
//echo "<br />";
//echo "= Add Tests =";
//echo "<br />";
//for ($i = 0; $i < 15; $i++) {
//    echo var_dump($testDAO->add(new Test(NULL, NULL, "Por que o céu é azul" . $i . "?", "Perguntas sem respostas", $comp)));
//}
//echo "<br />";
//echo "= Get Test =";
//echo "<br />";
//echo var_dump($testDAO->get(2));
//echo "<br />";
//echo "= Update Test =";
//echo "<br />";
//echo var_dump($testDAO->update(new Test(1, "2015-03-11 22:08:26", "Por que o céu é azul" . $i . "?", "Perguntas sem respostas", $comp)));
//echo "<br />";
//echo "= List Tests =";
//echo "<br />";
//echo var_dump($testDAO->listTests());
//echo "<br />";
//echo "= Remove Choice =";
//echo "<br />";
//echo var_dump($testDAO->remove(1));
//echo "<br />";
//echo "<br />";

//Choice
//echo "=== Choice ===";
//echo "<br />";
//echo "= Add Choices =";
//echo "<br />";
//echo "= Get Question =";
//$question = $questionDAO->get(2);
//for ($i = 0; $i < 5; $i++) {
//    echo var_dump($choiceDAO->add(new Choice(NULL, "porque ele nao é amarelo ". $i, FALSE, $question)));
//}
//echo "<br />";
//echo "= Get Choice =";
//echo "<br />";
//echo var_dump($choiceDAO->get(1));
//echo "<br />";
//echo "= Update Choice =";
//echo "<br />";
//echo var_dump($choiceDAO->update(new Choice(1, "por que ele nao é verde", TRUE, $question)));
//echo "<br />";
//echo "= List Choices =";
//echo "<br />";
//echo var_dump($choiceDAO->listChoices());
//echo "<br />";
//echo "= Remove Choice =";
//echo "<br />";
//echo var_dump($choiceDAO->remove(2));
//echo "<br />";
//echo "<br />";

//echo "=== Participant ===";
//echo "<br />";
//echo "= Get Competition =";
//$competition = $cDAO->get(2);
//echo var_dump($competition);
//echo "= Add Participant =";
//echo "<br />";
//echo var_dump($participantDAO->add(new Participant(NULL, "Participant 1", "participant1@email.com", "123", "Vasco", $competition)));
//echo "<br />";
//echo var_dump($participantDAO->add(new Participant(NULL, "Participant 2", "participant2@email.com", "123", "Vasco", $competition)));
//echo "<br />";
//echo "= Get Participant =";
//echo "<br />";
//echo var_dump($participantDAO->get(1));
//echo "= Participant Validate =";
//echo "<br />";
//echo "Email inexistente: " . var_dump($participantDAO->participantValidation("participant3@email.com", "123"));
//echo "Senha errada: " . var_dump($participantDAO->participantValidation("participant1@email.com", "1234"));
//echo "Certo: " . var_dump($participantDAO->participantValidation("participant1@email.com", "123"));
//echo "<br />";
//echo "= Update Participant =";
//echo "<br />";
//echo var_dump($participantDAO->update(new Participant(1, "Participant Segundo", "participant1@email.com", "123", "Vice", $competition)));
//echo "<br />";
//echo "= List Participants =";
//echo "<br />";
//echo var_dump($participantDAO->listParticipants());
//echo "<br />";
//echo "= Remove Participant =";
//echo "<br />";
//echo var_dump($participantDAO->remove(1));
//echo "<br />";
//echo "<br />";


//echo "=== TestParticipant ===";
//echo "<br />";
//echo "= Get Participant =";
//$participant = $participantDAO->get(2);
//echo var_dump($participant);
//echo "= Get Test =";
//$test = $testDAO->get(2);
//echo var_dump($test);
//echo "= Add TestParticipant =";
//echo "<br />";
//echo var_dump($testParticipantDAO->add(new TestParticipant(NULL, $participant, $test, FALSE)));
//echo "<br />";
//echo "= Get TestParticipant =";
//echo "<br />";
//echo var_dump($testParticipantDAO->get(1));
//echo "<br />";
//echo "= Update TestParticipant =";
//echo "<br />";
//echo var_dump($testParticipantDAO->update(new TestParticipant(NULL, $participant, $test, TRUE)));
//echo "<br />";
//echo "= List TestParticipants =";
//echo "<br />";
//echo var_dump($testParticipantDAO->listTestsParticipant());
//echo "<br />";
//echo "= Remove TestParticipant =";
//echo "<br />";
//echo var_dump($testParticipantDAO->remove(1));
//echo "<br />";
//echo "<br />";


echo "=== Answers ===";
echo "<br />";
echo "= Get TestParticipant =";
$testParticipant = $testParticipantDAO->get(2);
$question = $questionDAO->get(2);
$choice = $choiceDAO->get(1);
echo "= Add Answers =";
echo "<br />";
echo var_dump($answersDAO->add(new Answers(NULL, $testParticipant, $question, $choice)));
echo "<br />";
echo "= Get Answers =";
echo "<br />";
echo var_dump($answersDAO->get(1));
echo "<br />";
echo "= Update Answers =";
echo "<br />";
echo var_dump($answersDAO->update(new Answers(NULL, $testParticipant, $question, $choice)));
echo "<br />";
echo "= List Answers =";
echo "<br />";
echo var_dump($answersDAO->listAnswers());
echo "<br />";
echo "= Remove Answers =";
echo "<br />";
echo var_dump($answersDAO->remove(1));
echo "<br />";
echo "<br />";

/* Testar
 * 
 * Pronto, agora a gente faz o de Choice
 * Uhuuuu :) Simbora
 * 
 * 
 */