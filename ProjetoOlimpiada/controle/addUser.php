<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/CompetitionDAO.php";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/TestParticipantDAO.php";

$participantDAO = new ParticipantDAO();
$competitionDAO = new CompetitionDAO();
$testDAO = new TestDAO();
$testParticipantDAO = new TestParticipantDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $senha = (isset($_POST['inputSenha'])) ? $_POST['inputSenha'] : '';
    $turma = (isset($_POST['inputTurma'])) ? $_POST['inputTurma'] : '';
    $competition = (isset($_POST['inputCompetition'])) ? $_POST['inputCompetition'] : '';
    $test = (isset($_POST['inputTest'])) ? $_POST['inputTest'] : '';

    $id = 0;

    if ((!empty($nome)) && (!empty($email)) && (!empty($turma)) && (!empty($senha)) && (!empty($competition)) && (!empty($test))) {

        $user = new Participant($id, $nome, $email, $senha, $turma, $competitionDAO->get($competition));
        
        $user->setId($participantDAO->add($user));
        
        if ($user->getId() != 0) {
            
            $testParticipant = new TestParticipant($id, $user, $testDAO->get($test), false);
            
            if ($testParticipantDAO->add($testParticipant)) {
                header("Location: listUser.php");
            } else {
                header("Location: addUserForm.php");
            }
            
        } else {
            header("Location: addUserForm.php");            
        }
        
    } else {
        header("Location: addUserForm.php");
    }
}

