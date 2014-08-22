<?php
$url_path = $_SERVER["DOCUMENT_ROOT"]."/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/AlternativaDAO.php";
include_once "$url_path/modelo/Alternativa.php";

$dao = new AlternativaDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $alternativa = (isset($_POST['inputAlternativa'])) ? $_POST['inputAlternativa'] : '';
    $resposta = (isset($_POST['inputResposta'])) ? $_POST['inputResposta'] : '';
    $questao = (isset($_POST['id'])) ? $_POST['id'] : '';
    
   $id=0;
    
   if((!empty($alternativa)) && (!empty($resposta))){
    $choice = new Alternativa($id, $alternativa, $resposta);
     
    if ($dao->addAlternativa($choice, $questao)){
        header("Location: listaAlternativas.php?id=$questao");
     
    }
    } else {
        header("Location: addAlternativaForm.php?id=$questao");

    }
}

