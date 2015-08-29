<?php

$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/TestDAO.php";
include_once "$url_path/dao/QuestionDAO.php";

$testDAO = new TestDAO();
$questionDAO = new QuestionDAO();

// Verifica se um formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

// Salva duas variáveis com o que foi digitado no formulário
// Detalhe: faz uma verificação com isset() pra saber se o campo foi preenchido

    $topico = (isset($_POST['inputTopico'])) ? $_POST['inputTopico'] : '';
    $question = (isset($_POST['inputQuestion'])) ? $_POST['inputQuestion'] : '';
    $points = (isset($_POST['inputPoints'])) ? $_POST['inputPoints'] : '';
    $image = (isset($_FILES['inputImage'])) ? $_FILES['inputImage'] : '';
    $test = (isset($_POST['inputTest'])) ? $_POST['inputTest'] : '';

    $id = 0;
    $regDate = 0;


    if ((!empty($topico)) && (!empty($question))) {
       
        if(!empty($image)){    
        // Largura máxima em pixels
		$largura = 300;
		// Altura máxima em pixels
		$altura = 400;
		// Tamanho máximo do arquivo em bytes
		$tamanho = 2000000;
 
    	// Verifica se o arquivo é uma imagem
        $error=array();
    	if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $image["type"])){
     	   $error[1] = "Isso não é uma imagem.";
        } 
	
        // Pega as dimensões da imagem
        $dimensoes = getimagesize($image["tmp_name"]);

        // Verifica se a largura da imagem é maior que a largura permitida
        if($dimensoes[0] > $largura) {
                $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
        }

        // Verifica se a altura da imagem é maior que a altura permitida
        if($dimensoes[1] > $altura) {
                $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
        }

        // Verifica se o tamanho da imagem é maior que o tamanho permitido
        if($image["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
        }

        // Se não houver nenhum erro
        if (count($error) == 0) {

            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $image["name"], $ext);

            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];

            // Caminho de onde ficará a imagem
            $caminho_imagem = "../img/" . $nome_imagem;

             // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($image["tmp_name"], $caminho_imagem);
           } else if(count($error) != 0){
                foreach ($error as $erro) {
                        echo $erro . "<br />";
                }
        }
        }
            // Insere os dados no banco
            echo '<script>alert("oi)</script>';
            $question = new Question($id, $regDate, $question, $topico, $points, $nome_imagem, $testDAO->get($test));
            if ($questionDAO->add($question)) {
            header("Location: test.php?id=$test");
            }
         
            

        }

//        // Se houver mensagens de erro, exibe-as
//        if (count($error) != 0) {
//                foreach ($error as $erro) {
//                        echo $erro . "<br />";
//                }
//        }
        
}

