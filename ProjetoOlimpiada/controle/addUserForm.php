<!DOCTYPE html>
<html>
    <?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/CompetitionDAO.php";
    include_once "$url_path/dao/TestDAO.php";

    $compDAO = new CompetitionDAO();
    $testDAO = new TestDAO();
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
        <script type="text/javascript" src="../js/jquery-min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $("#inputCompetition").change(function(event) {

                    // Id da competição selecionada
                    var competition = $(this).find(":selected").attr("value");

                    // Dados a serem enviados na requisição
                    var dados = {competition: competition};

                    // URL de requisição
                    var url = "getTestsByCompetition.php";
                    
                    // Conteúdo a ser modificado
                    var html = "";

                    $.ajax({
                        type: "GET",
                        url: url,
                        async: false,
                        data: dados,
                        processData: true,
                        datatype: 'json',
                        success: function(data) {
                            
                           // html += '<option value="">-- Selecione o Teste --</option>';
                            
                            for (i = 0; i < data.tests.length; i++) {
                                html += '<input type="checkbox" name="prova" value="' + data.tests[i].id + '"/>' + data.tests[i].classification + '</br>';
                            }
                            
                            // Alterar lista de Testes
                            $("#inputTest").html(html);
                            
                        },
                        error: function(data) {
                            alert("Um erro ocorreu ao se conectar com o servidor");
                        }
                    });

                });
            });
        </script>

    </head>

    <body>
        <div id="wrapper">
            <div class="row">
                <div class="col-lg-12"><a href="../painelControle.html">Painel de Controle</a>->
                    <a href="listUser.php">Manter Usuário</a>->Adicionar Usuário</div>
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
                                <i class="fa fa-trophy fa-fw"></i> Adicionar Usuário
                            </div>
                            <div class="panel-body">

                                <form class="form-horizontal" method="POST" action="addUser.php">
                                    <div class="form-group">
                                        <label for="inputNome" class="control-label col-xs-2">Nome</label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" id="inputNome" name="inputNome" placeholder="Digite o Nome do Usuário" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="control-label col-xs-2">Email</label>
                                        <div class="col-xs-10">
                                            <input type="email" class="form-control" id="inputEmail" name="inputEmail" placeholder="Digite o Email do Usuário" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputTurma" class="control-label col-xs-2">Turma</label>
                                        <div class="col-xs-10">
                                            <input type="text" class="form-control" id="inputTurma" name="inputTurma" placeholder="Digite a Turma do Usuário" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSenha" class="control-label col-xs-2">Senha</label>
                                        <div class="col-xs-10">
                                            <input type="password" class="form-control" id="inputSenha" name="inputSenha" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCompetition" class="control-label col-xs-3">Competition</label>
                                        <div class="col-xs-9">
                                            <select class="form-control" id="inputCompetition" name="inputCompetition">
                                                <option value="">-- Selecione a Competição --</option>
                                                <?php
                                                $list = $compDAO->listCompetitions();
                                                foreach ($list as $row) {
                                                    print "<option value=" . $row->getId() . ">" . $row->getName() . "</option>";
                                                }
                                                ?>    
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputTest" class="control-label col-xs-3">Test</label>
                                        <div class="col-xs-9">
                                            <div id="inputTest" name="inputTest">
                                            </div>
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
