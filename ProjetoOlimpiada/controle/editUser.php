<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/UsuarioDAO.php";
include_once "$url_path/modelo/Usuario.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao = new UsuarioDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $turma = (isset($_POST['inputTurma'])) ? $_POST['inputTurma'] : '';
    $competicao = (isset($_POST['inputCompeticao'])) ? $_POST['inputCompeticao'] : '';
    
    if((!empty($nome)) && (!empty($email)) && (!empty($turma))){
        $usuario = $dao->getUsuario($id);
        $user = new Usuario($id, $nome, $email, $usuario['senha'], $turma, $competicao);
        
        if ($dao->updateUsuario($user)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
           header("Location: listaUser.php");
            
        } 
    }else{
            header("Location: editUser.php?id=$id");
    }
}

