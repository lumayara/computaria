<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/PerguntaDAO.php";

    $id = $_GET['id'];
    $dao = new PerguntaDAO();

    if ($dao->removePergunta($id)) {
        // O usuário e a senha digitados foram validados, manda pra página interna
          header("Location: listaProva.php");
          //  echo"$id deu certo";
    }else{
          header("Location: listaProva.php");
        //echo"$id nao deu certo";
    }

