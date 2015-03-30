<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/CompetitionDAO.php";
include_once "$url_path/modelo/Competition.class.php";

$dao = new CompetitionDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido
    $nome = (isset($_POST['inputNome'])) ? $_POST['inputNome'] : '';

    $data_realizacao = (isset($_POST['inputData'])) ? $_POST['inputData'] : '';
    //$data_time = (isset($_POST['inputTime'])) ? $_POST['inputTime'] : '';
    
    $id=0;
    //$data_realizacao = $data_realizacao.'T'.$data_time;
    
    if((!empty($nome)) && (!empty($data_realizacao))){
        $comp = new Competition($id, $nome, $data_realizacao);
        if ($dao->add($comp)) {
            header("Location: listComp.php");
        }       
    }else{
            header("Location: addComp.html");
    }
}

