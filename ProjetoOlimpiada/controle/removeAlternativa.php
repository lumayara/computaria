<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/AlternativaDAO.php";

    $id = $_GET['id'];
    $dao = new AlternativaDAO();

    if ($dao->removeAlternativa($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaAlternativas.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listaAlternativas.php");
        //echo"$id nao deu certo";
    }

