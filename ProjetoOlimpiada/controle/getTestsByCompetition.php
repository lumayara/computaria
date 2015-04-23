<?php

// Definindo o tipo de documento como JSON
header('Content-Type: application/json; charset=utf-8');


// Criar variável e retorno
$jsonReturn = '{"message": ';

// Verifica se existe requisição GET
if (isset($_GET)) {

    // Verificar se existe a chave requerida
    if (isset($_GET["competition"]) && $_GET["competition"] != NULL && $_GET["competition"] != "") {

        // Capturar id da competição selecionada
        $competitionId = $_GET["competition"];

        // Criar variável que receberá os tests no formato JSON
        $jsonTests = array();

        // Incluir arquivos necessários para realizar a busca
        require_once $_SERVER['DOCUMENT_ROOT'] . '/computaria/ProjetoOlimpiada/dao/TestDAO.php';

        // Criar novo DAO de Competition e Test
        $testDAO = new TestDAO();

        // Buscar testes da competição
        $tests = $testDAO->listTestsByCompetition($competitionId);

        if (count($tests) > 0) {
            // Adicionar mensagem de retorno
            $jsonReturn .= '"Testes recuperados com sucesso!"';

            // Adicionar resultados ao array JSON
            foreach ($tests as $key => $value) {
                $jsonTests[$key] = ["id" => $value->getId(), "classification" => $value->getClassification()];
            }
            
            // Adicionar o vetor de testes em formato JSON ao JSON de retorno
            $jsonReturn .= ', "tests": ' . json_encode($jsonTests) . '}';
            
        } else {
            $jsonReturn .= '"Nenhum teste encontrado para essa competição!"}';
        }
        
    } else {
        $jsonReturn .= '"Nenhuma competição foi informada"}';
    }
    
} else {
    $jsonReturn .= '"Acesso negado!"}';
}

echo $jsonReturn;