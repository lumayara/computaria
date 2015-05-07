<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/CompetitionDAO.php";
include_once "$url_path/dao/TestParticipantDAO.php";
include_once "$url_path/dao/TestDAO.php";

$userDAO = new ParticipantDAO();
$tpDAO = new TestParticipantDAO();

$id_user = $_GET['id'];

$participant = $userDAO->get($id_user);
$testsParticipant = $tpDAO->listTestsParticipant($participant->getId());
$testDAO = new TestDAO();
?>

<!DOCTYPE html>
<html>
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

        <!-- Contador -->
        <script type="text/javascript" src="../js/timer.js"></script>
    </head>

    <body> 

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
                        <h1 class="page-header"><i class="fa fa-smile-o"></i> Bem vindo(a), <?php echo $participant->getName() ?>!</h1>
                    </div>

                    <div class="col-md-4 col-md-offset-4">
                        <h1>Testes</h1>

                        <table>
                            <tr>
                                <th>Classificação</th>
                                <th>Início</th>
                                <th>Fim</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                            <?php
                            if ($testsParticipant) {
                                foreach ($testsParticipant as $testParticipant) {

                                    $started = (strtotime($testParticipant->getTest()->getStartDate()) <= time());

                                    $expired = (strtotime($testParticipant->getTest()->getEndDate()) < time());

                                    $finalized = $testParticipant->getFinalized();

                                    $linkavel = true;

                                    $link = "<a href='questionario.php?id={$testParticipant->getTest()->getID()}' title='Ir para o Teste'>Ir para o Teste</a>";
                                    ?>

                                    <tr>
                                        <td><?php echo $testParticipant->getTest()->getClassification(); ?></td>
                                        <td><?php echo $testParticipant->getTest()->getStartDate(); ?></td>
                                        <td><?php echo $testParticipant->getTest()->getEndDate(); ?></td>
                                        <td>
                                            <?php
                                            $idIt = "contador-" . $testParticipant->getTest()->getId();
                                            if (!$started) { // Teste não começou ainda
                                                ?>
                                                <p>Quase lá...</p>
                                                <p>Tempo para começar a prova: <span id="<?php echo $idIt; ?>"></span></p>

                                                <script type="text/javascript">
                                                    
                                                        atualizaContador("<?php echo $testParticipant->getTest()->getStartDate(); ?>",
                                                                "<?php echo $idIt; ?>");
                                                    
                                                </script>

                                                <?php
                                                $linkavel = false;
                                            } else if ($started && !$expired && !$finalized) { // Condição: Teste já iniciou, não encerrou e ainda não foi respondido
                                                ?>
                                                <p>Iniciado - Não finalizado</p>
                                                <p>Tempo restante: <span id="<?php echo $idIt; ?>"></span></p>

                                                <?php
                                            } else if ($started && !$expired && $finalized) { // Condição: Nao expirado, mas já respondido
                                                ?>
                                                <p>Iniciado - Finalizado!</p>
                                                <p>Tempo para o fim da prova: </p>
                                                <?php
                                            } else if ($expired && !$finalized) { // Condição: Teste expirou, mas não foi respondido
                                                ?>
                                                <p>Encerrado - Não finalizado</p>
                                                <?php
                                            } else if ($expired && $finalized) {
                                                ?>
                                                <p>Encerrado - Finalizado</p>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo ($linkavel ? $link : ""); ?>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            } else {
                                echo "<tr><td>Nenhum teste encontrado.</td></tr>";
                            }
                            ?>
                        </table>
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
