<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/QuestionDAO.php";
include_once "$url_path/modelo/Question.php";

$dao = new QuestionDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $question = (isset($_POST['inputQuestion'])) ? $_POST['inputQuestion'] : '';
    $competition = (isset($_POST['id'])) ? $_POST['id'] : '';
    
   $id=0;
   
    
   if((!empty($topico)) && (!empty($question))){
    $question = new Question($id, $question, $topico, $competition);
     
    if ($dao->addQuestion($question)) {
        header("Location: listTest.php?id=$competition");
    }
    } else {
        header("Location: addQuestionForm.php?id=$competition");

    }
}

