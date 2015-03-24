<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/AdministratorDAO.php";
include_once "$url_path/modelo/Administrator.class.php";

$dao = new AdministratorDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = (isset($_POST['inputEmail'])) ? $_POST['inputEmail'] : '';
    $senha = (isset($_POST['inputSenha'])) ? $_POST['inputSenha'] : '';
    
   $id=0;
    
   if((!empty($email)) && (!empty($senha))){
    $admin = new Administrator($id, $email, $senha);
     
    if ($dao->add($admin)) {
        header("Location: listaAdmin.php");
    }
    } else {
        header("Location: ../addAdmin.html");

    }
}

