<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/modelo/Usuario.php";

    $id = $_GET['id'];
    $dao = new ParticipantDAO();

    if ($dao->removeUsuario($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listUser.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listUser.php");
        //echo"$id nao deu certo";
    }

