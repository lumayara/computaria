<?php
$url_path = $_SERVER["DOCUMENT_ROOT"] . "/computaria/ProjetoOlimpiada";
include_once "$url_path/dao/ParticipantDAO.php";
include_once "$url_path/dao/TestParticipantDAO.php";
include_once "$url_path/modelo/Question.class.php";

$userDAO = new ParticipantDAO();
$testParticipantDAO = new TestParticipantDAO();

// Iniciar Sessão
session_start();

if (isset($_SESSION["user"])) {

    $participant = $userDAO->get($_SESSION["user"]);

    $question = new Question(1, NULL, NULL, NULL, NULL, 1);

    if (isset($_GET["id"])) {

        $test = $testParticipantDAO->get($_GET["id"])->getTest();
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script>

                <meta charset="utf-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">

                <title>WidIF - Questionário</title>

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
                            <div class="col-lg-8">
                                <h1>Competição: <?php echo $participant->getCompetition()->getName(); ?></h1>
                                <div class="questionaire-header">
                                    <h2><i class="fa fa-pencil-square-o fa-fw"></i>Questionário - <?php echo $test->getClassification(); ?></h2>
                                    <div><p id="qtde-questions"></p></div>
                                </div>

                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row -->
                        <div class="row">
                            <div class="col-lg-8">
                                <form role="form" method="post" id="form-submit-question" action="questionnaireControl.php">
                                    <input id="question-id" type="hidden" name="question" value="" />
                                    <div class="question chat-panel panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa  fa-file-text-o fa-fw"></i>
                                            <span id="question-title"></span>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <ul id="chat" class="chat">
                                                <!-- Bloco da mensagem-->
                                                <li class="left clearfix">

                                                    <div class="chat-body clearfix">
                                                        <div class="header">
                                                            <strong class="primary-font"><span id="question-topic"></span></strong>
                                                            <strong class="primary-font"> - <span id="question-points"></span> Pontos</strong>
                                                        </div>
                                                        <p><span id="question"></span></p>
                                                    </div>
                                                </li>
                                                <!-- Fim Bloco da mensagem-->    
                                                <li class="right clearfix">

                                                    <div class="chat-body clearfix">

                                                        <p>Alternativas:</p>

                                                        <ul id="question-choices">

                                                        </ul>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                        <!-- /.panel-body -->
                                        <div class="panel-footer">
                                            <div class="progress">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only"></span>
                                                </div>
                                            </div>
                                            <div class="input-group">

                                                <button id="btn-submit" class="btn btn-warning btn-sm" type="submit">
                                                    Submeter
                                                </button>

                                            </div>
                                        </div>
                                        <!-- /.panel-footer -->
                                    </div>
                                    <!-- /.panel .chat-panel -->
                                </form>
                            </div>
                            <!-- /.col-lg-8 -->
                            <div class="col-lg-4">
                                <div class="scroll-panel panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-users fa-fw"></i> Ranking
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
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

                <script type="text/javascript">

                    $(document).ready(function() {
                        setQuestion();
                        setRanking();
                    });

                    var url = "questionnaireControl.php";

                    $("form#form-submit-question").submit(function(event) {
                        event.preventDefault();

                        $(".progress").show(0);
                        $(".progress-bar").addClass("progress-bar-animate");

                        var $form = $(this);

                        var requiredData = {
                            type: "SUBMIT",
                            id: <?php echo $_GET["id"]; ?>,
                            questionId: $form.find("input[name='question']").val(),
                            choiceId: $form.find("input[name='choice']:checked").val()
                        };

                        $.ajax({
                            type: "POST",
                            url: url,
                            async: false,
                            data: requiredData,
                            processData: true,
                            datatype: 'json',
                            success: function(data) {

                                if (data.success) {

                                    setTimeout(
                                            function()
                                            {
                                                setQuestion();
                                                $(".progress").hide(0);
                                                $(".progress-bar").removeClass("progress-bar-animate");
                                            }, 2000);

                                } else {
                                    alert("Erro ao responder a questão. " + data.message);
                                }

                            },
                            error: function(data) {
                                question = {
                                    message: "Um erro ocorreu ao se conectar com o servidor"
                                };
                            }
                        });

                    });

                    function setQuestion() {

                        var requiredData = {
                            type: "QUESTION",
                            id: <?php echo $_GET["id"]; ?>
                        };
                        var question;
                        var qtdeQuestions;

                        $.ajax({
                            type: "POST",
                            url: url,
                            async: false,
                            data: requiredData,
                            processData: true,
                            datatype: 'json',
                            success: function(data) {

                                question = data.question;
                                qtdeQuestions = data.qtdeQuestions;

                            },
                            error: function(data) {
                                question = {
                                    message: "Um erro ocorreu ao se conectar com o servidor"
                                };
                            }
                        });

                        // Limpar Informações da Questão
                        clear();

                        // Informações da Questão
                        $("#qtde-questions").html(qtdeQuestions + (qtdeQuestions > 1 ? " questões restantes" : " questão restante"));
                        $("#question-id").attr("value", question.id);
                        $("#question-title").html(question.question);
                        $("#question-topic").html(question.topic);
                        $("#question-points").html(question.points);
                        // Alternativas da Questão
                        for (var i = 0; i < question.choices.length; i++) {
                            $("#question-choices").append(
                                    '<li>' +
                                    '<input type="radio" ' +
                                    'id="choice-' + question.choices[i].id + '" ' +
                                    'name="choice"' +
                                    'value="' + question.choices[i].id + '" />' +
                                    '<label for="choice-' + question.choices[i].id + '">' + question.choices[i].choice + '</label>' +
                                    '</li>'

                                    );
                        }

                    }

                    function clear() {

                        // Informações da Questão
                        $("#qtde-questions").html("");
                        $("#question-id").attr("value", "");
                        $("#question-title").html("");
                        $("#question-topic").html("");
                        $("#question-points").html("");
                        // Alternativas da Questão
                        $("#question-choices").html("");

                    }

                    // Ranking
                    function setRanking() {

                        var requiredData = {
                            id: <?php echo $test->getId(); ?>
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
                                    '<a href="#" class="list-group-item' + (ranking[i].testParticipant.finalized == 1 ? " finalized" : "") + '">' +
                                    '<span>' + (i + 1) + '</span>' +
                                    '<span>' + ranking[i].testParticipant.participant.name + '</span>' +
                                    '<span class="small"><em>' + ranking[i].answered + '</em></span>' +
                                    '<span class="small"><em>' + ranking[i].rights + '</em></span>' +
                                    '<span class="small"><em>' +
                                    ranking[i].points + "" + (ranking[i].points === 1 ? " ponto" : " pontos") +
                                    '</em></span>' +
                                    '<span class="small"><em>' + ranking[i].completionTime + '</em></span>' +
                                    '</a>'
                                    );
                        }
                        
                        setTimeout(function(){setRanking()}, 5000);

                    }

                </script>

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

        <?php
    }
} else {
    header("Location: ../login.html");
}
?>