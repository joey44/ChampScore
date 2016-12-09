<?php
session_start();


if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    /* $_SESSION['visited'] = true; */
} else {
    /*echo "Du hast diese Seite zuvor schon aufgerufen";*/
}
?>
<!DOCTYPE html>
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



        <!-- Navigation -->
        <nav class="navbar top-nav navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="public_html/ChampScoreIndex.php">CHAMPSCORE®</a>
            </div>
            <!-- Top Menu Items -->

        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            All Competitions

                        </h1>


                    </div>
                </div>
                <!-- /.row -->

            </div>


            <?php
            require ("./public_html/php/loginsec/db.inc.php");

            $link = mysqli_connect("localhost", $benutzer, $passwort);
            mysqli_select_db($link, $dbname);
            $abfrage = "select comp_ID, comp_name, comp_date from tbl_competition";
            $ergebnis = mysqli_query($link, $abfrage) or die(mysqli_error());

            echo "<div id=\"products\" class=\"row list-group\">";
            while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
                $ranglisteID = $zeile['comp_ID'];
                echo "<div name\"$ranglisteID\" class=\"item  col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-4 col-md-offset-0 col-lg-4 col-lg-offset-0\">";
                echo "<div class=\"thumbnail\">";
                echo "<a href=\"ScoreboardView.php?comp_ID=$ranglisteID\"><img class=\"group list-group-image\" src=\"http://placehold.it/400x250/000/fff\" alt=\"\" />";
                echo "<div class=\"row\">";
                
                echo "<div class=\"col-xs-6 col-md-6 col-sm-6 col-lg-6\">";
                echo "<div class=\"caption\">";
                echo "<h4 class=\"group inner list-group-item-heading\"><b>" .
                $zeile['comp_name'] . "</b></h4>";
                echo "<p class=\"group inner list-group-item-text\">" . $zeile['comp_date'] . "</p>";
                echo "</div>";
                echo "</div>";
/*
                echo "<div class=\"col-xs-6 col-md-6 col-sm-6 col-lg-6\">";
                echo "<div class=\"caption\">";
                echo "<a class=\"btn btn-primary\" href=ScoreboardView.php?comp_ID=$ranglisteID>Show more</a>";
                echo "</div>";
                echo "</div>";
                
                */
                echo "</div>"; //row
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";

            mysqli_close($link);
            ?>

            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->


        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>

    </body>

</html>

