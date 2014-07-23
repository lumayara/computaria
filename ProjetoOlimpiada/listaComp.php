<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WidIF</title>

    <!-- Core CSS - Include with every page -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body>
    <?php 
    include_once './dao/CompeticaoDAO.php';
 
    $compDAO = new CompeticaoDAO();
    ?>

    <div id="wrapper">

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
                    <h1 class="page-header"><i class="fa fa-cog fa-fw"></i>Painel de Controle</h1>
                </div>
                <!-- /.col-lg-12 -->
                
            </div>
            <!-- /.row -->
            
           <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                           <i class="fa fa-trophy fa-fw"></i> Manter Competicao
                        </div>
                        <div class="panel-body">
                            <p><h4><i class="fa fa-list fa-fw"></i><a href="listaComp.php"> Ver Competições</a></h4></p>
                        </div>
                        
                    </div>
                </div>
               <!-- /.col-lg-4 -->
               <div class="col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i>Manter Usuário
                        </div>
                        <div class="panel-body">
                             <p><h4><i class="fa fa-list fa-fw"></i><a href="#"> Ver Participantes</a></h4></p>
                        </div>
                        
                    </div>
                </div>
               <!-- /.col-lg-4 -->
               <div class="col-lg-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <i class="fa fa-user fa-fw"></i>Manter Administrador
                        </div>
                        <div class="panel-body">
                            <p><h4><i class="fa fa-list fa-fw"></i><a href="#"> Ver Administradores</a></h4></p>
                        </div>
                        
                    </div>
                </div>
               <!-- /.col-lg-4 --> 
     <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Striped Rows
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?while($) ?>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
           </div> 
          <!-- /#row-->
        
            
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="js/plugins/morris/raphael-2.1.0.min.js"></script>
    <script src="js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="js/demo/dashboard-demo.js"></script>

</body>

</html>
