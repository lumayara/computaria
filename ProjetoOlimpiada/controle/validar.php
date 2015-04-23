<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/AdministratorDAO.php";


$dao = new ParticipantDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $email = (isset($_POST['email'])) ? $_POST['email'] : '';

    $senha = (isset($_POST['password'])) ? $_POST['password'] : '';

    $remember = isset($_POST['senha']);

    if (isset($_POST['Administrator'])) {
        $dao = new AdministratorDAO();
        if ($dao->userValidate($email, $senha)) {

            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: ../painelControle.html");
        } else {

            // O usuário e/ou a senha são inválidos, manda de volta pro form de login
            // Para alterar o endereço da página de login, verifique o arquivo seguranca.php

            header("Location: ../loginAdmin.html");
        }
    }

// Utiliza uma função pra validar os dados digitados
    else if (isset($_POST['usuario'])) {
        $user = $dao->participantValidation($email, $senha);
        if ($user) {
            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: alunoTelaInicial.php?id=" . $user->getId());
        } else {
            header("Location: ../login.html");
        }
    }
}
