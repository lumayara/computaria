<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/AdministratorDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/CompetitionDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestDAO.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/QuestionDAO.php';

$adminDAO = new AdministratorDAO();
$cDAO = new CompetitionDAO();
$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();

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
//echo var_dump($testDAO->add(new Test(NULL, "medio", $cDAO->get(2))));
//echo "<br />";
//echo var_dump($testDAO->add(new Test(NULL, "superior", $cDAO->get(2))));
//echo "<br />";
//echo "= Get Test =";
//echo "<br />";
//echo var_dump($testDAO->get(2));
//echo "<br />";
//echo "= Update Test =";
//echo "<br />";
//echo var_dump($testDAO->update(new Test(1, "superior", $cDAO->get(2))));
//echo "<br />";
//echo "= List Tests =";
//echo "<br />";
//echo var_dump($testDAO->listTests());
//echo "<br />";
//echo "= Remove Test =";
//echo "<br />";
//echo var_dump($testDAO->remove(1));
//echo "<br />";
//echo "<br />";

//Questionario
$test = $testDAO->get(2);

echo "=== Question ===";
echo "<br />";
echo "= Add Questions =";
echo "<br />";
for ($i = 0; $i < 15; $i++) {
    echo var_dump($questionDAO->add(new Question(NULL, NULL, "Por que o céu é azul" . $i . "?", "Perguntas sem respostas", $test)));
}
echo "<br />";
echo "= Get Question =";
echo "<br />";
echo var_dump($questionDAO->get(2));
echo "<br />";
echo "= Update Question =";
echo "<br />";
echo var_dump($questionDAO->update(new Question(1, "2015-03-11 22:08:26", "Por que o céu é azul" . $i . "?", "Perguntas sem respostas", $test)));
echo "<br />";
echo "= List Questions =";
echo "<br />";
echo var_dump($questionDAO->listQuestions());
echo "<br />";
echo "= Remove Question =";
echo "<br />";
echo var_dump($questionDAO->remove(1));
echo "<br />";
echo "<br />";

//Testar