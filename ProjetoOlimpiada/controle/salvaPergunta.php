<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/UsuarioDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $userDAO = new UsuarioDAO();
    $id_user = $_POST['id_user'];
    $id_alternativa = $_POST['id_alternativa'];

    $usuario = $userDAO->addRespostas($id_user, $id_alternativa);
    
  