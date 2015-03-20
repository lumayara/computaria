<!DOCTYPE html>
<html>
<?php
    $url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
    include_once "$url_path/dao/ParticipantDAO.php";
    include_once "$url_path/dao/QuestionDAO.php";
    include_once "$url_path/dao/ChoiceDAO.php";
    include_once "$url_path/conexao/ConnectionFactory.php";
    $userDAO = new ParticipantDAO();
    $questionDAO = new QuestionDAO();
    $choiceDAO = new ChoiceDAO();
    $id_user = $_GET['id'];
    $usuario = $userDAO->getUsuario($id_user);
    $competition_id = $usuario['competition_id'];
    $listQuestions = $questionDAO->listarQuestoesByCompetition($competition_id);
    
    shuffle($listQuestions);
 

    ?>
<head>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3/jquery.min.js"></script>
    <script>
       var size = "<?php echo sizeof($listQuestions)?>";  
       var total =0;
        function mostraQuestao() {
            alert("Alert "+total);
                "<?php $total = "<script>document.write(total)</script>";
                $total = $total*1;?>";
                alert("<?php echo "Total $total"?>");
                if (total*1 < size) {                
                "<?php $questao = $listQuestions[$total];?>";
                "<?php $choices = $choiceDAO->listarChoicesByQuestao($questao['id']); shuffle($choices);?>";
                document.getElementById('topico').innerHTML = "<?php echo $questao['topico']?>";
                document.getElementById('question').innerHTML = "<?php echo $questao['question']?>";
                document.getElementById('respostas').innerHTML = "<?php foreach ($choices as $choice) {
                    echo "<p><input type='radio' name='Choice' value='".$choice['id']."'> "
                            .$choice['Choice']."</p>";
                    }?>"; 
                } else {
                    alert("ja era");
                }
          }
        
      $(document).ready(function() {
         
            $("#form").submit(function(){                
                 var id_user = "<?php echo $id_user?>";
                
                    var valor = "";
                    //Executa Loop entre todas as Radio buttons com o name de valor
                    $('input:radio[name=Choice]').each(function() {
                        //Verifica qual está selecionado
                        if ($(this).is(':checked'))
                            valor = $(this).val();
                    });
                    alert(valor);
              
                 var id_Choice = valor;
                
            $.ajax({
                    url: "salvaQuestion.php",
                    type: "POST",
                    dataType: " json",
                    data: { id_user: id_user, id_Choice: id_Choice},
                    success: function (data) { sucesso(data) },
                     error: function (jqXHR, textStatus, errorThrown) { erro(); }
                    });
            });
            
            function sucesso(data) {
                 total++;
                 alert("Total sucesso"+total);
                 mostraQuestao();    
                 alert("okkkkk");
            }
            function erro() {
               console.log("ERRO!!!");
            }
            
        });
          
          window.onload = mostraQuestao;
      
        </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>WidIF</title>

    <!-- Core CSS - Include with every page -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Page-Level Plugin CSS - Dashboard -->
    <link href="../css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <link href="../css/plugins/timeline/timeline.css" rel="stylesheet">

    <!-- SB Admin CSS - Include with every page -->
    <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body>

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
                    <h1 class="page-header"><i class="fa  fa-pencil-square-o fa-fw"></i>Questionário</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
           <div class="row">
                <div class="col-lg-8">
                    <div class="chat-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa  fa-file-text-o fa-fw"></i>
                            Questao 1                   
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <ul id="chat" class="chat">
                                <!-- Bloco da mensagem-->
                                <li class="left clearfix">
                                    
                                    <div class="chat-body clearfix">
                                        <div class="header">
                                            <strong class="primary-font"><span id="topico"></span></strong> 
                                 
                                        </div>
                                        <p><span id="question"></span></p>
                                    </div>
                                </li>
                                <!-- Fim Bloco da mensagem-->    
                                <li class="right clearfix">
                                   
                                    <div class="chat-body clearfix">
                                        
                                        <p>
                                            Respostas:</p>
                                        <span id="respostas"></span>
                                    </div>
                                </li>
                                
                            </ul>
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <div class="input-group">
                                <form role="form" method="post" id="form" action="javascript:void(0)">

                                    <span class="input-group-btn">
                                        <input type="submit" class="btn btn-warning btn-sm" id="btn-chat" value="Submeter"/>
                                    </span>
                                   
                                </form>
                            </div>
                        </div>
                        <!-- /.panel-footer -->
                    </div>
                    <!-- /.panel .chat-panel -->
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="scroll-panel panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users fa-fw"></i> Ranking
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 1
                                    <span class="pull-right text-muted small"><em>58 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 2
                                    <span class="pull-right text-muted small"><em>57 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 3
                                    <span class="pull-right text-muted small"><em>48 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 4
                                    <span class="pull-right text-muted small"><em>45 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 5
                                    <span class="pull-right text-muted small"><em>40 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 6
                                    <span class="pull-right text-muted small"><em>40 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 7
                                    <span class="pull-right text-muted small"><em>38 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 8
                                    <span class="pull-right text-muted small"><em>37 pontos</em>
                                    </span>
                                </a>
                                <a href="#" class="list-group-item">
                                    <i class="fa fa-child fa-fw"></i> Usuário 9
                                    <span class="pull-right text-muted small"><em>36 pontos</em>
                                    </span>
                                </a>
                            </div>
                            <!-- /.list-group -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->                                        
                </div>
                <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Core Scripts - Include with every page -->
    
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/plugins/metisMenu/jquery.metisMenu.js"></script>
    

    <!-- Page-Level Plugin Scripts - Dashboard -->
    <script src="../js/plugins/morris/morris.js"></script>

    <!-- SB Admin Scripts - Include with every page -->
    <script src="../js/sb-admin.js"></script>

    <!-- Page-Level Demo Scripts - Dashboard - Use for reference -->
    <script src="../js/demo/dashboard-demo.js"></script>

</body>

</html>