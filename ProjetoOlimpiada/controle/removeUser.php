<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";

    $id = $_GET['id'];
    $dao = new ParticipantDAO();

    if ($dao->remove($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listUser.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listUser.php");
        //echo"$id nao deu certo";
    }

