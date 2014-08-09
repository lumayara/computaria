<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/UsuarioDAO.php";
include_once "$url_path/modelo/Usuario.php";

$dao = new UsuarioDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $turma = (isset($_POST['inputTurma'])) ? $_POST['inputTurma'] : '';
    $competicao = (isset($_POST['inputCompeticao'])) ? $_POST['inputCompeticao'] : '';
    $senha = (isset($_POST['inputSenha'])) ? $_POST['inputSenha'] : '';
    
   $id=0;
    
   if((!empty($nome)) && (!empty($email)) && (!empty($turma)) && (!empty($senha))){
    $user = new Usuario($id, $nome, $email, $senha, $turma, $competicao);
     
    if ($dao->addUsuario($user)) {
        header("Location: listaUser.php");
    }
    } else {
        header("Location: addUserForm.php");

    }
}

