<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/QuestionDAO.php";

    $id = $_GET['id'];
    $dao = new QuestionDAO();
    $test = $dao->get($id)->getTest();
    if ($dao->remove($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: test.php?id=".$test->getId());
          //  echo"$id deu certo";
    }else{
          header("Location: test.php?id=".$test->getId());
        //echo"$id nao deu certo";
    }

