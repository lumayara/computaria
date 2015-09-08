<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/modelo/Test.class.php";

$dao = new TestDAO();
// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário

// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $classification = (isset($_POST['inputClassification'])) ? $_POST['inputClassification'] : '';
    $startDate = (isset($_POST['inputDate'])) ? $_POST['inputDate'] : '';
    $startTime = (isset($_POST['inputTimeStart'])) ? $_POST['inputTimeStart'] : '';
    $endTime = (isset($_POST['inputTimeEnd'])) ? $_POST['inputTimeEnd'] : '';
    $competition = (isset($_POST['id'])) ? $_POST['id'] : '';
  
   $id=0;
   
   $startTime = $startDate.'T'.$startTime;
   $endTime = $startDate.'T'.$endTime;
   
   if((!empty($startTime)) && (!empty($endTime))){
    $test = new Test($id, $classification, $startTime, $endTime, $competition);
     
    if ($dao->add($test)) {
        echo "here: ".$test->getClassification();
       header("Location: competition.php?id=$competition");
    }
    } else {
        header("Location: addTestForm.php?id=$competition");

    }
}

