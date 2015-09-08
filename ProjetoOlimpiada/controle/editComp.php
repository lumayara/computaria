<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
include_once "$url_path/dao/CompetitionDAO.php";
include_once "$url_path/modelo/Competition.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao= new CompetitionDAO();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';
    $data_realizacao = (isset($_POST['inputData'])) ? $_POST['inputData'] : '';
    $data_time = (isset($_POST['inputTime'])) ? $_POST['inputTime'] : '';
   
    $data_realizacao = $data_realizacao.'T'.$data_time;
    if((!empty($nome)) && (!empty($data_realizacao))){
        $competition = new Competition($id, $nome, $data_realizacao);
        // Utiliza uma função pra validar os dados digitados

        if ($dao->updateComp($competition)){
        // O usuário e a senha digitados foram validados, manda pra página interna
         header("Location: listComp.php");
            
        } 
    }else{
            header("Location: editCompetition.php?id=$id");
    }
}

