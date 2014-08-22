<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/AlternativaDAO.php";
include_once "$url_path/modelo/Alternativa.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao= new AlternativaDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $alternativa = (isset($_POST['inputAlternativa'])) ? $_POST['inputAlternativa'] : '';
    $resposta = (isset($_POST['inputResposta'])) ? $_POST['inputResposta'] : '';
   
    if((!empty($alternativa)) && (!empty($resposta))){
        $novaAlternativa = new Alternativa($id, $alternativa, $resposta);
        $alt = $dao->getAlternativa($id);
        // Utiliza uma função pra validar os dados digitados

        if ($dao->updateAlternativa($novaAlternativa)){
        // O usuário e a senha digitados foram validados, manda pra página interna
         header("Location: listaAlternativas.php?id=".$alt['id_question']);
        
        } 
    }else{
            header("Location: editAlternativaForm.php?id=$id");
    }
}

