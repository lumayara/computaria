<!DOCTYPE html>
<html>
    <?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/TestDAO.php";
    include_once "$url_path/dao/QuestionDAO.php";
    
    $testDAO = new TestDAO();
    $questionDAO = new QuestionDAO();
    
    $id = $_GET["id"];
    
    $test = $testDAO->get($id);
    
    ?>
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>WidIF</title>

        <!-- Core CSS - Include with every page -->
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

        <!-- Page-Level Plugin CSS - Dashboard -->
        <link href="../css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
        <link href="../css/plugins/timeline/timeline.css" rel="stylesheet">

        <!-- SB Admin CSS - Include with every page -->
        <link href="../css/sb-admin.css" rel="stylesheet">

    </head>

    <body>

        <div id="wrapper">
            <div class="row">
                <div class="col-lg-12"><a href="../painelControle.html">Painel de Controle</a>->
                    <a href="listComp.php">Manter Competição</a>
                    -> Prova</div>
            </div>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">Olimpif</a>
                </div>
                <!-- /.navbar-header -->

                <ul class="nav navbar-top-links navbar-right">                                
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Sair</a>
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
                    
                    <div>
                        <h1>Prova</h1>
                        <p><b>Classificação: </b><?php echo $test->getClassification(); ?></p>
                        <p><b>Data de Início: </b><?php echo $test->getStartDate(); ?></p>
                        <p><b>Data de Fim: </b><?php echo $test->getEndDate(); ?></p>
                        <p><b>Competição: </b><?php echo $test->getCompetition()->getName(); ?></p>
                    </div>
                    
                    <div>
                        <h2>Questões para essa prova</h2>
                    </div>

                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-4">
                        <a href="addQuestionForm.php?id=<?php echo $id ?>" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Adicionar Nova Questão</a> 

                    </div>
                    <!-- /.col-lg-4 --> 
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Lista de Questões
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Tópico</th>
                                                <th>Question</th>
                                                <th>Alternativas</th>
                                                <th>Editar</th>
                                                <th>Remover</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $list = $questionDAO->listQuestionsByTest($test->getId());
                                            foreach ($list as $question) {
                                                print "<tr>"
                                                        . "<td>" . $question->getTopic() . "</td>"
                                                        . "<td>" . $question->getQuestion() . "</td>"
                                                        . "<td>"
                                                        . "<a href='listaChoices.php?id=" . $question->getId() . "'>Visualizar</a>"
                                                        . "</td>"
                                                        . "<td>"
                                                        . "<a href='editTestForm.php?id=" . $question->getId() . "'>Editar</a>"
                                                        . "</td>"
                                                        . "<td>"
                                                        . "<a href='removeQuestion.php?id=" . $question->getId() . "'>Remover</a>"
                                                        . "</td>"
                                                        . "</tr>";
                                            }
                                            ?> 
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div> 
                <!-- /#row-->


            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- Core Scripts - Include with every page -->
        <script src="../js/jquery-1.10.2.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>

        <!-- Page-Level Plugin Scripts - Dashboard -->
        <script src="../js/plugins/morris/raphael-2.1.0.min.js"></script>
        <script src="../js/plugins/morris/morris.js"></script>

        <!-- SB Admin Scripts - Include with every page -->
        <script src="../js/sb-admin.js"></script>

        <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
        <script src="../js/demo/dashboard-demo.js"></script>

    </body>

</html>
