<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
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
    
    // Iniciar Sessão
    session_start();

    if (isset($_POST['Administrator'])) {
        $dao = new AdministratorDAO();
        // Resgatar Administrador
        $admin = $dao->userValidate($email, $senha);
        // Utiliza uma função pra validar os dados digitados
        if ($admin) {
            
            // Colocar Usuário na Sessão
            $_SESSION["admin"] = $admin->getId();

            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: ../painelControle.php");
        } else {

            // O usuário e/ou a senha são inválidos, manda de volta pro form de login
            // Para alterar o endereço da página de login, verifique o arquivo seguranca.php

            header("Location: ../loginAdmin.html");
        }
    } else if (isset($_POST['usuario'])) {
        $user = $dao->participantValidation($email, $senha);
        if ($user) {
            // Colocar Usuário na Sessão
            $_SESSION["user"] = $user->getId();
            // O usuário e a senha digitados foram validados, manda pra página interna
            header("Location: alunoTelaInicial.php");
        } else {
            header("Location: ../login.html");
        }
    }
}
