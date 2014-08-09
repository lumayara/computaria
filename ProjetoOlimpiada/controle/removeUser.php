<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/UsuarioDAO.php";
include_once "$url_path/modelo/Usuario.php";

    $id = $_GET['id'];
    $dao = new UsuarioDAO();

    if ($dao->removeUsuario($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaUser.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listaUser.php");
        //echo"$id nao deu certo";
    }

