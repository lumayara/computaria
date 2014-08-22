<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/PerguntaDAO.php";
include_once "$url_path/modelo/Pergunta.php";

$dao = new PerguntaDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $pergunta = (isset($_POST['inputPergunta'])) ? $_POST['inputPergunta'] : '';
    $competicao = (isset($_POST['id'])) ? $_POST['id'] : '';
    
   $id=0;
   
    
   if((!empty($topico)) && (!empty($pergunta))){
    $question = new Pergunta($id, $pergunta, $topico, $competicao);
     
    if ($dao->addPergunta($question)) {
        header("Location: listaProva.php?id=$competicao");
    }
    } else {
        header("Location: addQuestaoForm.php?id=$competicao");

    }
}

