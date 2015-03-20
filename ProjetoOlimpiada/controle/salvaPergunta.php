<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/ParticipantDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $userDAO = new ParticipantDAO();
    $id_user = $_POST['id_user'];
    $id_Choice = $_POST['id_Choice'];
    $total = $_POST['total'];
    $usuario = $userDAO->addRespostas($id_user, $id_Choice);
    $total++;
  