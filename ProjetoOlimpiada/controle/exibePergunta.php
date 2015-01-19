<?php
   include_once "$url_path/dao/AlternativaDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $alternativaDAO = new AlternativaDAO();
    $total = $_POST['total'];
    $listPerguntas = $_POST['listPerguntas'];
    
    $questao = $listPerguntas[$total]++;
    $alternativas = $alternativaDAO->listarAlternativasByQuestao($questao['id']); shuffle($alternativas);
   
 echo json_encode($questao);
    echo json_encode($alternativas);
    
   
