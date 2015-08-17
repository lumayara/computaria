<?php

// Definindo o tipo de documento como JSON
header('Content-Type: application/json; charset=utf-8');

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";

include_once "$url_path/dao/TestParticipantDAO.php";

$testParticipantDAO = new TestParticipantDAO();

// Criar variável de retorno
$jsonReturn;

// Verifica existência de usuário logado
if (TRUE) {
// if (isset($_SESSION["user"])) {
    // Resgata usuario da sessão
    // $participant = $userDAO->get($_SESSION["user"]);
    // Verificar se existe 
    if (isset($_GET)) {

        // Verificar se existe id para questionário --Test Id
        if (isset($_GET["id"])) {

            // TestParticipant
            $ranking = $testParticipantDAO->getRanking($_GET["id"]);

            // Vetor JSON
            $rankingVector = array();

            for ($i = 0; $i < count($ranking); $i++) {
                $rankingVector[$i] = array(
                    "testParticipant" => array(
                        "id" => $ranking[$i]->getTestParticipant()->getId(),
                        "participant" => array(
                            "id" => $ranking[$i]->getTestParticipant()->getParticipant()->getId(),
                            "name" => mb_convert_encoding($ranking[$i]->getTestParticipant()->getParticipant()->getName(), "UTF-8", "Windows-1252"),
                            "email" => mb_convert_encoding($ranking[$i]->getTestParticipant()->getParticipant()->getEmail(), "UTF-8", "Windows-1252"),
                            "team" => mb_convert_encoding($ranking[$i]->getTestParticipant()->getParticipant()->getTeam(), "UTF-8", "Windows-1252"),
                        ),
                        "finalized" => $ranking[$i]->getTestParticipant()->getFinalized(),
                        "startTime" => $ranking[$i]->getTestParticipant()->getStartTime(),
                        "endTime" => $ranking[$i]->getTestParticipant()->getEndTime(),
                    ),
                    "completionTime" => $ranking[$i]->getConclusionTime(),
                    "points" => $ranking[$i]->getPoints(),
                    "answered" => $ranking[$i]->getAnswered(),
                    "rights" => $ranking[$i]->getRights()
                );
            }

            // Retorno
            $jsonReturn = array(
                "message" => "Ranking resgatado com sucesso!",
                "ranking" => $rankingVector
            );
        } else {
            $jsonReturn = array("message" => "Não foi possível recuperar a questão. Identificação não fornecida.");
        }
    } else {
        $jsonReturn = array("message" => "Não foi possível realizar a operação. Acesso negado!");
    }
}
// Retornar valor em formato JSON
echo json_encode($jsonReturn, JSON_UNESCAPED_UNICODE);
