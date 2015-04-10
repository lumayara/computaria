<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ChoiceDAO.php";
include_once "$url_path/dao/QuestionDAO.php";

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $id = $_POST['id'];
    $dao= new ChoiceDAO();
    $choice_old = $dao->get($id);
    $question_id = $choice_old->getQuestion();


// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $choice = (isset($_POST['inputChoice'])) ? $_POST['inputChoice'] : '';
    $resposta = (isset($_POST['inputResposta'])) ? $_POST['inputResposta'] : '';
   
    if((!empty($choice))){
        
        $novaChoice = new Choice($id, $choice, $resposta, $question_id);
     
        // Utiliza uma função pra validar os dados digitados

        if ($dao->update($novaChoice)){
        // O usuário e a senha digitados foram validados, manda pra página interna
         header("Location: listaChoices.php?id=".$choice_old->getQuestion()->getId());
        
        } 
    }else{
            header("Location: editChoiceForm.php?id=$id");
    }
}

