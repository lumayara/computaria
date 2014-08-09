<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/CompeticaoDAO.php";

    $id = $_GET['id'];
    $dao = new CompeticaoDAO();

    if ($dao->removeCompeticao($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaComp.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listaComp.php");
        //echo"$id nao deu certo";
    }

