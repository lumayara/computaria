<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/PerguntaDAO.php";
include_once "$url_path/modelo/Pergunta.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao= new PerguntaDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $question = (isset($_POST['inputPergunta'])) ? $_POST['inputPergunta'] : '';
    $oldPergunta = $dao->getPergunta($id);
    $competicao = $oldPergunta['id_competicao'];
    if((!empty($topico)) && (!empty($question))){
        $pergunta = new Pergunta($id, $question, $topico, $competicao);
        // Utiliza uma função pra validar os dados digitados

        if ($dao->updatePergunta($pergunta)){
        // O usuário e a senha digitados foram validados, manda pra página interna
         header("Location: listaProva.php?id=$id");   
        } 
    }else{
            header("Location: editProvaForm.php?id=$id");
    }
}

