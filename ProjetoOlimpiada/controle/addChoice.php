<?php
$url_path = $_SERVER["DOCUMENT_ROOT"]."/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ChoiceDAO.php";
include_once "$url_path/modelo/Choice.class.php";

$dao = new ChoiceDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $choice = (isset($_POST['inputChoice'])) ? $_POST['inputChoice'] : '';
    $resposta = (isset($_POST['inputResposta'])) ? $_POST['inputResposta'] : '';
    $questao = (isset($_POST['id'])) ? $_POST['id'] : '';
    
   $id=0;
    
   if((!empty($choice)) && (!empty($resposta))){
    $choice = new Choice($id, $choice, $resposta);
     
    if ($dao->add($choice, $questao)){
        header("Location: listaChoices.php?id=$questao");
     
    }
    } else {
        header("Location: addChoiceForm.php?id=$questao");

    }
}

