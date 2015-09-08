<!DOCTYPE html>
<html>
    <?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/comp/ProjetoOlimpiada";
    include_once "$url_path/dao/CompetitionDAO.php";
    include_once "$url_path/dao/TestParticipantDAO.php";
    include_once "$url_path/dao/TestDAO.php";
    $compDAO = new CompetitionDAO();
    $testDAO = new TestDAO();
    $testPartDAO = new TestParticipantDAO();
    ?>
    <head>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <title>WidIF - Questionário</title>
                <script src="../js/jquery-1.10.2.js"></script>
                <!-- Core CSS - Include with every page -->
                <link href="../css/bootstrap.min.css" rel="stylesheet">
                <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

                <!-- Page-Level Plugin CSS - Dashboard -->
                <link href="../css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
                <link href="../css/plugins/timeline/timeline.css" rel="stylesheet">

                <!-- SB Admin CSS - Include with every page -->
                <link href="../css/sb-admin.css" rel="stylesheet">

                <link href="../css/questionaire.css" rel="stylesheet" type="text/css">

    </head>

    <body>

        <div id="wrapper">
            <div class="row">
                <div class="col-lg-12"><a href="../painelControle.php">Painel de Controle</a>->Ver Ranking</div>
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

                    <div class="col-lg-12">
                        <h1 class="page-header"><i class="fa fa-cog fa-fw"></i>Ver Ranking</h1>
                    </div>
                    <!-- /.col-lg-12 -->

                </div>
                <!-- /.row -->
                <div class="row">
                    
                    <!-- /.col-lg-4 --> 
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Todos os Rankings
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                
                                <div class="scroll-panel panel panel-default">
                                      <div class="list-group" id="ranking-area">
                                            <header class="list-group-item">
                                                <span>Pos</span>
                                                <span>Participante</span>
                                                <span>Feitas</span>
                                                <span>Certas</span>
                                                <span>Pontos</span>
                                                <span>Tempo</span>
                                            </header>
                                            <div class="list-group">

                                            </div>
                                        </div>
                                        <!-- /.list-group -->
                                  
                                </div>
                                <!-- /.panel -->                                        
                            
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
        <script src="../js/jquery-1.10.2.js"></script>
   
        <script type="text/javascript">
         
                    $(document).ready(function() {
                        var index;
                       alert("oi");
                        <?php 
                        $tests=$testDAO->listTests();
                        for ($i=0; $i<count($tests); $i++){
                            ?>
                            index=<?php echo $tests[$i]->getId();?>
                            
                            setRanking(index);
                         alert(<?php echo $tests[$i]->getId()?>);
                       <?php } ?>
                        
                       
                    });
                    
                  // Ranking -editar
                    function setRanking(id) {

                        //var requiredData = {
                        //    id: <//?php echo $test->getId(); ?>
                        //};
                        var requiredData = {
                            id: id
                        };
                        var ranking;

                        $.ajax({
                            type: "GET",
                            url: 'rankingControl.php',
                            async: false,
                            data: requiredData,
                            processData: true,
                            datatype: 'json',
                            success: function(data) {

                                ranking = data.ranking;

                            },
                            error: function(data) {
                                alert("Um erro ocorreu ao se conectar com o servidor");
                            }
                        });

                        // Limpar área do Ranking
                        $("#ranking-area > div").html("");

                        // Classificação do Ranking
                        for (var i = 0; i < ranking.length; i++) {
                            $("#ranking-area > div").append(
                                    '<a href="#" class="list-group-item">' +
                                    '<span>' + (i + 1) + '</span>' +
                                    '<span class="name">' + 
                                    (ranking[i].testParticipant.finalized == 1 ? '<i class="fa fa-check"></i>' : '') +
                                    ranking[i].testParticipant.participant.name + 
                                    '</span>' +
                                    '<span class="small"><em>' + ranking[i].answered + '</em></span>' +
                                    '<span class="small"><em>' + ranking[i].rights + '</em></span>' +
                                    '<span class="small"><em>' +
                                    ranking[i].points + "" + (ranking[i].points === 1 ? " ponto" : " pontos") +
                                    '</em></span>' +
                                    '<span class="small"><em>' + ranking[i].completionTime + '</em></span>' +
                                    '</a>'
                                    );
                        }

                        

                    }   
        </script>
        
        
        <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
         <script src="../js/bootstrap.min.js"></script>

                <!-- Page-Level Plugin Scripts - Dashboard -->
                <script src="../js/plugins/morris/morris.js"></script>

                <!-- SB Admin Scripts - Include with every page -->
                <script src="../js/sb-admin.js"></script>

                <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
                <script src="../js/demo/dashboard-demo.js"></script>

    </body>

</html>
