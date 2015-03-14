<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/AdministratorDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/CompetitionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/QuestionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/ChoiceDAO.php';

$adminDAO = new AdministratorDAO();
$cDAO = new CompetitionDAO();
$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();
$choiceDAO = new ChoiceDAO();

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
echo "=== Choice ===";
echo "<br />";
echo "= Add Choices =";
echo "<br />";
echo "= Get Question =";
$question = $questionDAO->get(2);
for ($i = 0; $i < 5; $i++) {
    echo var_dump($choiceDAO->add(new Choice(NULL, "porque ele nao é amarelo ". $i, FALSE, $question)));
}
echo "<br />";
echo "= Get Choice =";
echo "<br />";
echo var_dump($choiceDAO->get(1));
echo "<br />";
echo "= Update Choice =";
echo "<br />";
echo var_dump($choiceDAO->update(new Choice(1, "por que ele nao é verde", TRUE, $question)));
echo "<br />";
echo "= List Choices =";
echo "<br />";
echo var_dump($choiceDAO->listChoices());
echo "<br />";
echo "= Remove Choice =";
echo "<br />";
echo var_dump($choiceDAO->remove(2));
echo "<br />";
echo "<br />";



/* Testar
 * 
 * Pronto, agora a gente faz o de Choice
 * Uhuuuu :) Simbora
 * 
 * 
 */