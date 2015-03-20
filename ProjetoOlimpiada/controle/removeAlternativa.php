<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ChoiceDAO.php";

    $id = $_GET['id'];
    $dao = new ChoiceDAO();

    if ($dao->removeChoice($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaChoices.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listaChoices.php");
        //echo"$id nao deu certo";
    }

