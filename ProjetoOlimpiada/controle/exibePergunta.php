<?php
   include_once "$url_path/dao/ChoiceDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $choiceDAO = new ChoiceDAO();
    $total = $_POST['total'];
    $listQuestions = $_POST['listQuestions'];
    
    $questao = $listQuestions[$total]++;
    $choices = $choiceDAO->listarChoicesByQuestao($questao['id']); shuffle($choices);
   
 echo json_encode($questao);
    echo json_encode($choices);
    
   
