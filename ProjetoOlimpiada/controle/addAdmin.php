<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/AdministradorDAO.php";
include_once "$url_path/modelo/Administrador.php";

$dao = new AdministradorDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $senha = (isset($_POST['inputSenha'])) ? $_POST['inputSenha'] : '';
    
   $id=0;
    
   if((!empty($email)) && (!empty($senha))){
    $admin = new Administrador($id, $email, $senha);
     
    if ($dao->addAdministrador($admin)) {
        header("Location: listaAdmin.php");
    }
    } else {
        header("Location: ../addAdmin.html");

    }
}

