<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ChoiceDAO.php";
include_once "$url_path/dao/QuestionDAO.php";

    $id = $_GET['id'];
    $dao = new ChoiceDAO();
    $question = $dao->get($id)->getQuestion();
    if ($dao->remove($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaChoices.php?id=".$question->getId());
          //  echo"$id deu certo";
    }else{
          header("Location: listaChoices.php");
        //echo"$id nao deu certo";
    }

