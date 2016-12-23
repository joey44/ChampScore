<?php
session_start();

if ($_SESSION['eingeloggt'] == false){
    
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

        <!-- Bootstrap Core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="css/sb-admin.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <!-- Custom Fonts -->
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

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
                                Athlete

                            </h1>
                            
                        </div>
                    </div>
                    <!-- /.row -->
                    <!--
                    <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-custom-black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-fire fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">3</div>
                                        <div>Competition requests</div>
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
                        <div class="panel panel-custom-black">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-tasks fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class="huge">2</div>
                                        <div>coming Competitions</div>
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
                        <div class="panel panel-custom-black">
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
                        <div class="panel panel-custom-black">
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
                        <div class="col-lg-6">
                            <h3 class="page-header">
                                Register for a Competition

                            </h3>
                            <p>Look for Competitions and sign up with the Registration Code provided
                            by the Host. You can also request a participation in the Competition</p>
                            
                                
                                    <p><a href="enterRegCode.php" class="btn btn-custom-red btn-lg" role="button">Enter Code <i class="fa fa-arrow-circle-right"></i></a>
                                    </p>
                                
                        </div>
                        <div class="col-lg-6">
                            <h3 class="page-header">
                                Registered Competitions

                            </h3>
                            <p>Your upcoming Competitions are listed here</p>
                           
                                
                                
                                    
                                    <?php
                                    require ("./public_html/php/loginsec/db.inc.php");

                                    $link = mysqli_connect("localhost", $benutzer, $passwort);
                                    mysqli_select_db($link, $dbname);
                                    $abfrage = "select comp_ID, comp_name, comp_date from tbl_competition where comp_ID IN ( select fk_comp_ID from tbl_division join tbl_user_division on tbl_user_division.fk_div_ID = tbl_division.div_ID where tbl_user_division.fk_user_id = " . $_SESSION['user_id']. ")";
                                    $ergebnis = mysqli_query($link, $abfrage) or die(mysqli_error());



                                    echo"<br><div class=\"table-responsive\">
                                    <table class=\"table  table-hover table-striped\">
                                        <thead>
                                            <tr>
                                                <th>Competition</th>
                                                <th>When</th>
                                                
                                                
                                            </tr>
                                        </thead>
                                        <tbody>";

                                    while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
                                        $ranglisteID = $zeile['comp_ID'];

                                        $zeile['comp_name'] . "</b></h4>";
                                       
                                       
                                        

                                        echo "<tr id=\"row" . $zeile['comp_ID'] . "\">
                                                <td><a href = \"ScoreboardView.php?comp_ID=$ranglisteID\" >" . $zeile['comp_name'] . "</a></td>
                                                <td>" . $zeile['comp_date'] . "</td>
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
