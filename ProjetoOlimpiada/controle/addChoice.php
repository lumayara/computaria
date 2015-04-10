<?php
$url_path = $_SERVER["DOCUMENT_ROOT"]."/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ChoiceDAO.php";
include_once "$url_path/dao/QuestionDAO.php";
$dao = new ChoiceDAO();
$questionDAO = new QuestionDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $choice_string = (isset($_POST['inputChoice'])) ? $_POST['inputChoice'] : '';
    $resposta = (isset($_POST['inputResposta'])) ? $_POST['inputResposta'] : '';
    $questao = (isset($_POST['id'])) ? $_POST['id'] : '';
    
   $id=0;
   $question_class = $questionDAO->get($questao);

   if((!empty($choice_string))){
       
    $choice = new Choice($id, $choice_string, intval($resposta), $question_class);
    
    if ($dao->add($choice)){
        
        header("Location: listaChoices.php?id=$questao");
     
    }
    } else {
        header("Location: addChoiceForm.php?id=$questao");
       
    }
}

