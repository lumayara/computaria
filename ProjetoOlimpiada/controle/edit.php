<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/CompeticaoDAO.php";
include_once "$url_path/modelo/Competicao.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao = new CompeticaoDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $data_realizacao = (isset($_POST['inputData'])) ? $_POST['inputData'] : '';
    if((!empty($nome)) && (!empty($data_realizacao))){
        $competicao = new Competicao($id, $nome, $data_realizacao);
        // Utiliza uma função pra validar os dados digitados

        if ($dao->updateComp($competicao)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: listaComp.php");
            
        } 
    }else{
            header("Location: editCompeticao.php?id=$id");
    }
}

