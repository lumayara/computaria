<!DOCTYPE html>
<html>
<?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
    include_once "$url_path/dao/TestDAO.php";
    
    $testDAO = new TestDAO();
    $id = $_GET["id"];
    
    $test = $testDAO->get($id);
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
               <div class="col-lg-12"><a href="../painelControle.php">Painel de Controle</a>->
                    <a href="listComp.php">Lista Competições</a>
                    -> <a href="competition.php?id=<?php echo $test->getCompetition()->getId() ?>">Competição</a>
                    -> <a href="test.php?id=<?php echo $test->getId() ?>">Prova</a>-> Adicionar Questão</div>
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
                  <i class="fa fa-trophy fa-fw"></i> Adicionar Questão
              </div>
    <div class="panel-body">

    <form class="form-horizontal" method="POST" enctype="multipart/form-data" action="addQuestion.php">
        <input type="hidden" value="<?php echo $id ?>" name="inputTest" />
    <div class="form-group">
        <label for="inputTopico" class="control-label col-xs-2">Tópico</label>
        <div class="col-xs-10">
            <input type="text" class="form-control" id="inputTopico" name="inputTopico" placeholder="Digite o tópico da questão" required>
        </div>
    </div>
    <div class="form-group">
        <label for="inputQuestion" class="control-label col-xs-3">Questão</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="inputQuestion" name="inputQuestion" placeholder="Digite a questão" required>
        </div>
    </div>
    
    <div class="form-group">
        <label for="inputImage" class="control-label col-xs-3">Imagem (Opcional)</label>
        <div class="col-xs-9">
            <input type="file" class="form-control" id="inputImage" name="inputImage">
        </div>
    </div>
        
    <div class="form-group">
        <label for="inputPoints" class="control-label col-xs-3">Pontos</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="inputPoints" name="inputPoints" value="1">
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
    </div>


    <!-- Core Scripts - Include with every page -->
    <script src="../js/jquery-1.10.2.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>

</body>

</html>
