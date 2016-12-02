<?php
session_start();


if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    /* $_SESSION['visited'] = true; */
} else {
    echo "Du hast diese Seite zuvor schon aufgerufen";
}
?>




<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/wizard.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="../js/wizard.js"></script>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../prettify.css" rel="stylesheet">
        <script src="../js/sidebar.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
        <link rel="stylesheet" href="../css/wizard.css" type="text/css">
        <link rel="stylesheet" href="../css/sidebar.css">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- jQuery -->
        <script src="../vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Plugin JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="../vendor/scrollreveal/scrollreveal.min.js"></script>
        <script src="../vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

        <!-- Theme JavaScript -->
        <script src="../js/creative.min.js"></script>

        <title>ChampScore</title>

        <!-- Bootstrap Core CSS -->
        <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

        <!-- Plugin CSS -->
        <link href="../vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

        <!-- Theme CSS -->
        <link href="../css/creative.min.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body id="page-top">


        <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand page-scroll" href="#page-top">ChampScore®</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">


                        <?php
                        if (isset($_SESSION['visited'])) {

                            echo "<li> <A HREF =loginsec/logout.php>Log out</A></li> ";
                        }
                        ?>

                        <li>
                            <a class="page-scroll" href="#about">About</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#services">Services</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#portfolio">Pricing</a>
                        </li>
                        <li>
                            <a class="page-scroll" href="#contact">Contact</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <header>
            <div id="wrapper">
                <!-- <div class="overlay"></div> -->

                <?php
                if (isset($_SESSION['visited'])) {

                    /*    echo "<li> <A HREF =loginsec/logout.php>Log out</A></li> ";
                      "<div id=\"products\" class=\"row list-group\">" */

                    echo "<nav class=\"navbar navbar-inverse navbar-fixed-top\" id=\"sidebar-wrapper\" role=\"navigation\">
                                 <ul class=\"nav sidebar-nav\">
                                 <li class=\"sidebar-brand\">
                                 <p></p><span class=\"glyphicon glyphicon-cog\"></span>
                                </li>
                                
                        <li>
                          
                        </li>
                        <li>
                            <a href=\"person.php\" data-toggle =\"tooltip\" data-placement=\"right\" title=\"User\"> <span class=\"glyphicon glyphicon-user\"></span > User</a>
                        </li>
                        <li>
                            <a href=\"box.php\"> <span class=\"glyphicon glyphicon-home\"></span> Box</a>
                        </li>
                        <li>
                            <a href=\"scoreboard.php\"><span class=\"glyphicon glyphicon-th-list\"> </span> Board</a>
                        </li>
                        <li>
                            <a href=\"reports.php\"><span class=\"glyphicon glyphicon-stats\"></span> Report</a>
                        </li>
                    </ul>
                    </nav>";
                }
                ?>

                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">

                    <!--<div class="container">-->
                    <h1>All Competitions</h1>

                    <div class="container">
                        <!-- <div class="well well-sm">
                             <strong>Display</strong>
                             <div class="btn-group">
                                 <a href="#" id="list" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-th-list">
                                 </span>List</a> <a href="#" id="grid" class="btn btn-default btn-sm"><span
                                     class="glyphicon glyphicon-th"></span>Grid</a>
                             </div>
                         </div> -->
                        <div id="products" class="row list-group ">

                            <?php
                            require ("./loginsec/db.inc.php");

                            $link = mysqli_connect("localhost", $benutzer, $passwort);
                            mysqli_select_db($link, $dbname);
                            $abfrage = "select ranglisteID, name from rangliste";
                            $ergebnis = mysqli_query($link, $abfrage) or die(mysqli_error());

                            echo "<div id=\"products\" class=\"row list-group\">";
                            while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
                                $ranglisteID = $zeile['ranglisteID'];
                                echo "<div name\"$ranglisteID\" class=\"item  col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-4 col-md-offset-0 col-lg-4 col-lg-offset-0\">";
                                echo "<div class=\"thumbnail\">";
                                echo "<img class=\"group list-group-image\" src=\"http://placehold.it/400x250/000/fff\" alt=\"\" />";
                                echo "<div class=\"caption\">";
                                echo "<h4 class=\"group inner list-group-item-heading\"><b>" .
                                    $zeile['name'] . "</b></h4>";
                                
                                /*while (list($schluessel, $wert) = each($zeile)) {
                                    
                                    
                                }*/

                                echo "<p class=\"group inner list-group-item-text\">Beschreibung</p>";
                                echo "</br>";
                                echo "<div class=\"row\">";
                                echo "<div class=\"col-xs-12 col-md-6\">";
                                echo "<p class=\"lead\">$21.000</p></div>";
                                echo "<div class=\"col-xs-12 col-md-6\">";
                                echo "<a class=\"btn btn-primary\" href=ScoreboardView.php?id=$ranglisteID>Show more</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                            }
                            echo "</div>";

                            mysqli_close($link);
                            ?>


                        </div>
                    </div>

                </div>
            </div>

            <!-- /#wrapper -->


        </header>

        <!-- Menu Toggle Script-->

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>


        <script type="text/javaScript">
            $("#menu-toggle").click( function(e){
            e.preventDefault();
            $("#wrapper").toggleClass("menuDisplayed");
            });


        </script>


    </body>
</html>