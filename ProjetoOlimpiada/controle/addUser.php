<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/modelo/Participant.class.php";

$dao = new ParticipantDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $turma = (isset($_POST['inputTurma'])) ? $_POST['inputTurma'] : '';
    $competition = (isset($_POST['inputCompetition'])) ? $_POST['inputCompetition'] : '';
    $senha = (isset($_POST['inputSenha'])) ? $_POST['inputSenha'] : '';
    
   $id=0;
    
   if((!empty($nome)) && (!empty($email)) && (!empty($turma)) && (!empty($senha))){
    $user = new Participant($id, $nome, $email, $senha, $turma, $competition);
     
    if ($dao->add($user)) {
        header("Location: listUser.php");
    }
    } else {
        header("Location: addUserForm.php");

    }
}

