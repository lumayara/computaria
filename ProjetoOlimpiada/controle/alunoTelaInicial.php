<!DOCTYPE html>
<html>
    <?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/ParticipantDAO.php";
    include_once "$url_path/dao/CompetitionDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $userDAO = new ParticipantDAO();
    $compDAO = new CompetitionDAO();
    $id_user = $_GET['id'];

    $usuario = $userDAO->getUsuario($id_user);
    $competition_id = $usuario['competition_id'];
    $competition = $compDAO->getCompetition($competition_id);
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
        <script>
            function atualizaContador() {
                var hoje = new Date();
                var fuso = (hoje.getTimezoneOffset() / 60) - 3;
                if (fuso)
                    hoje = new Date(hoje.valueOf() + (fuso * 3600000));
                var futuro = new Date("<?php echo $competition['data_realizacao']?>");
                
                var ss = parseInt((futuro - hoje) / 1000);
                var mm = parseInt(ss / 60);
                var hh = parseInt(mm / 60);
                var dd = parseInt(hh / 24);

                ss = ss - (mm * 60);
                mm = mm - (hh * 60);
                hh = hh - (dd * 24);


                var faltam = '';
                faltam += (dd && dd > 1) ? dd + ' dias, ' : (dd == 1 ? '1 dia, ' : '');
                faltam += (toString(hh).length) ? hh + ' hr, ' : '';
                faltam += (toString(mm).length) ? mm + ' min e ' : '';
                faltam += ss + ' seg';
                
                if (dd + hh + mm + ss > 0) {
                    document.getElementById('contador').innerHTML = "Espere só mais um pouco... Faltam: "+faltam;
                    setTimeout(atualizaContador, 1000);
                } else {
                    document.getElementById('contador').innerHTML = 'Sua hora chegou! '+'<a href="questionario_1.php?id=<?php echo $id_user?>">Iniciar Teste</a>';
                    setTimeout(atualizaContador, 1000);
                }
          }
          //window.onload = atualizaContador();
        </script>
    </head>

    <body onload="atualizaContador()"> 

        <div id="wrapper">
            <div class="row">
                <div class="col-lg-12">Tela Inicial</div>
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
                        <h1 class="page-header"><i class="fa fa-smile-o"></i> Bem vindo(a), <?php echo $usuario['nome'] ?>!</h1>
                    </div>

                    <div class="col-md-4 col-md-offset-4">
                        <img src="../img/waiting.png"/>
                        <h1><span id="contador"></span></h1>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /row -->           
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
