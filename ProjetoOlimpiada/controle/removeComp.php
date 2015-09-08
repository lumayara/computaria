<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
include_once "$url_path/dao/CompetitionDAO.php";

    $id = $_GET['id'];
    $dao = new CompetitionDAO();

    if ($dao->remove($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listComp.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listComp.php");
        //echo"$id nao deu certo";
    }

