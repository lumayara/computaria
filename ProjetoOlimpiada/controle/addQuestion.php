<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/QuestionDAO.php";

$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $question = (isset($_POST['inputQuestion'])) ? $_POST['inputQuestion'] : '';
    $test = (isset($_POST['inputTest'])) ? $_POST['inputTest'] : '';

    $id = 0;
    $regDate = 0;


    if ((!empty($topico)) && (!empty($question))) {
        $question = new Question($id, $regDate, $question, $topico, $testDAO->get($test));

        if ($questionDAO->add($question)) {
            header("Location: test.php?id=$test");
        }
    } else {
        header("Location: addQuestionForm.php?id=$test");
    }
}

