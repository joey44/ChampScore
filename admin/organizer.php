<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/ChampScoreIndex.php");
    exit();
}
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ChampScore</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script type="text/javascript">

//Funktion zur Prüfung der Registrierungsdaten
            function deleteComp(comp_ID)
            {



                var del_comp_id = comp_ID;
                var info = 'comp_ID=' + del_comp_id;
                alert(info);
                if (confirm("Sure you want to delete this Competition? This cannot be undone later.")) {
                    $.ajax({
                        type: "POST",
                        url: "deleteComp.php", //URL to the delete php script
                        data: info,
                        success: function () {
                            $("#row" + del_comp_id).animate("fast").animate({
                                opacity: "hide"
                            }, "slow");
                        },
                        error: function () {
                            alert("Fehler")
                        },
                    });

                }
                return false;


            }
        </script>
    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php include './navigation.php'; ?>

            <div id="page-wrapper">

                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">
                                Competition Host

                            </h1>


                        </div>
                    </div>
                    <!-- /.row -->
                    <!--
                                        <div class="row">
                                            <div class="col-lg-3 col-md-6">
                                                <div class="panel panel-custom-red">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-user fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge">26</div>
                                                                <div>Athletes signed in!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="panel panel-custom-red">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-tasks fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge">1</div>
                                                                <div>Active Competition!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="panel panel-custom-red">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-shopping-cart fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge">124</div>
                                                                <div>New Orders!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-md-6">
                                                <div class="panel panel-custom-red">
                                                    <div class="panel-heading">
                                                        <div class="row">
                                                            <div class="col-xs-3">
                                                                <i class="fa fa-support fa-5x"></i>
                                                            </div>
                                                            <div class="col-xs-9 text-right">
                                                                <div class="huge">13</div>
                                                                <div>Support Tickets!</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a href="#">
                                                        <div class="panel-footer">
                                                            <span class="pull-left">View Details</span>
                                                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                                            <div class="clearfix"></div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>-->
                    <div class="row">
                        <div class="col-lg-12">

                            <h3 class="page-header">
                                My Competitions  

                            </h3>
                            <p>Customize your Competitions. You can add new Competitions, edit and delete existing ones</p>

                            <a href = "competitionCustomize.php" >New <i class="fa fa-plus"></i></a>
                            <br>
                            <?php
                            require ("./public_html/php/loginsec/db.inc.php");

                            $link = mysqli_connect("localhost", $benutzer, $passwort);
                            mysqli_select_db($link, $dbname);
                            $abfrage = "select comp_ID, comp_name, comp_date, comp_active from tbl_competition where fk_user_id = " . $_SESSION['user_id'];
                            $ergebnis = mysqli_query($link, $abfrage) or die(mysqli_error());



                            echo"<br><div class=\"table-responsive\">
                                    <table class=\"table  table-hover table-striped\">
                                        <thead>
                                            <tr>
                                                <th>Competition</th>
                                                <th>Date</th>
                                                <th>Active</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>";

                            while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
                                $ranglisteID = $zeile['comp_ID'];

                                $zeile['comp_name'] . "</b></h4>";
                                $valActive = 0;
                                $AddResultsField = "";
                                if ($zeile['comp_active'] == 1) {

                                    $valActive = "<i class=\"fa fa-check\"></i>";
                                    $AddResultsField = "<a href = \"competitionAddScore.php?comp_ID=$ranglisteID\" ><i class=\"fa fa-plus\"></i> Add Score</a>";
                                } else {
                                    $valActive = "";
                                    $AddResultsField = "";
                                }




                                echo "<tr id=\"row" . $zeile['comp_ID'] . "\">
                                                <td><a href = \"ScoreboardView.php?comp_ID=" . $zeile['comp_ID'] . "\" target=\"_blank\" >" . $zeile['comp_name'] . "</a></td>
                                                <td>" . $zeile['comp_date'] . "</td>
                                                <td>" . $valActive . "</td>
                                                <td><a href = \"#\" ><i class=\"fa fa-th-list\"></i> Edit Competition</a></td>
                                                <td><a href = \"scoreboardPreview.php?comp_ID=" . $zeile['comp_ID'] . "\" target=\"_blank\" ><i class=\"fa fa-th-list\"></i> Scoreboard</a></td>
                                                <td><a href = \"judgeSheetsGen.php?comp_ID=". $zeile['comp_ID'] . "\"  ><i class=\"fa fa-th-list\"></i> Judging Sheets</a></td>
                                                
                                                <td>" . $AddResultsField . "</td>
                                                <td><a href = \"javascript:;\" onclick=\"deleteComp(" . $zeile['comp_ID'] . ");\" ><i class=\"fa fa-trash\"></i> Delete</a></td>
                                                </tr>";
                            }

                            echo"</tbody>
                                    </table>
                                </div>";


                            mysqli_close($link);
                            ?>



                        </div>


                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>
