<!DOCTYPE html>
<html>
<?php 
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/ChoiceDAO.php";
    include_once "$url_path/dao/QuestionDAO.php";
    $choiceDAO = new ChoiceDAO();
    $pergDAO = new QuestionDAO();
    $id = $_GET["id"];
  
    $choice = $choiceDAO->getChoice($id);
    
    $id_question = $choice['id_question'];
    
    $question = $pergDAO->getQuestion($id_question);
    
    $competition_id = $question['competition_id'];
    
    ?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Olimpif - Questions e Respostas com resultados em tempo real</title>

    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body>
    <div id="wrapper">
        <div class="row">
                <div class="col-lg-12"><a href="../painelControle.html">Painel de Controle</a>->
                    <a href="listComp.php">Manter Competição</a>
                    -><a href="listTest.php?id=<?php echo $competition_id ?>">Ver Questões</a>->
                    <a href="listaChoices.php?id=<?php echo $id_question ?>">Ver Choices</a>
                    -> Editar Choice
                    </div>
        </div>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="login.html">Olimpif - Login do Participante</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-right">                                
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="loginAdmin.html"><i class="fa fa-user fa-fw"></i> Acessar como Administrator</a>
                        </li>
                        
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
 <div id="page-wrapper">
   <div class="row">
       <br>
       <br>
       <div class="col-md-4 col-md-offset-4">
          <div class="panel panel-success">
              <div class="panel-heading">
                  <i class="fa fa-trophy fa-fw"></i> Editar Questão
              </div>
    <div class="panel-body">
                
        <form class="form-horizontal" method="POST" action="editChoice.php">
    <div class="form-group">
        <input type="hidden" value="<?php echo $id ?>" name="id" />
        <div class="form-group">
        <label for="inputChoice" class="control-label col-xs-2">Choice</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="inputChoice" name="inputChoice" value="<?php echo $choice['Choice']?>" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputResposta" class="control-label col-xs-3">Resposta</label>
        <div class="col-xs-9">
            <select class="form-control" id="inputResposta" name="inputResposta">
               
                <option value="certa">Verdadeira</option>
                <option value="errada">Falsa</option>
                    
            </select>
        </div>
    </div>   
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </div>
</form>
   
 </div>
       </div>
   </div>
 </div>
    </div>
 

    <!-- Core Scripts - Include with every page -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>

</body>

</html>
