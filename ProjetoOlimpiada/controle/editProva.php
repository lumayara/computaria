<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/QuestionDAO.php";
include_once "$url_path/modelo/Question.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao= new QuestionDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $question = (isset($_POST['inputQuestion'])) ? $_POST['inputQuestion'] : '';
    $oldQuestion = $dao->getQuestion($id);
    $competition = $oldQuestion['competition_id'];
    if((!empty($topico)) && (!empty($question))){
        $question = new Question($id, $question, $topico, $competition);
        // Utiliza uma função pra validar os dados digitados

        if ($dao->updateQuestion($question)){
        // O usuário e a senha digitados foram validados, manda pra página interna
         header("Location: listTest.php?id=$id");   
        } 
    }else{
            header("Location: editProvaForm.php?id=$id");
    }
}

