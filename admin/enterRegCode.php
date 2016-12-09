<?php
session_start();

if ($_SESSION['eingeloggt'] == false){
    
    header("Location: public_html/ChampScoreIndex.php");
    exit();
}

if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    $_SESSION['visited'] = true;
} else {
    /*echo "Du hast diese Seite zuvor schon aufgerufen";*/
}
?>
<html lang="en">

    <head>

        <!-- jQuery -->



        <script src="http://code.jquery.com/jquery-latest.min.js"></script>

        <script src="js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>


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

        <script type="text/javascript">

//Funktion zur Prüfung der Registrierungsdaten
            function mySubmitRegCode()
            {
                
                 var comp = '&comp_ID=' + comp_ID;
                var code = document.getElementById('regcode'+comp_ID).value;
                var regcode = 'regcode=' + code;
                
                var division = '&div_ID=' + document.querySelector('input[name = "Division'+comp_ID + '" ]:checked').value;
                var all = regcode + comp + division;
                
                $.ajax({
                    type: "POST",
                    url: "checkRegCode.php",
                    cache: false,
                    data: all,
                    success: function (html)
                    {
                        $( '#msg' + comp_ID).html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

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
                                Enter Registration Code
                                <small>Athlete</small>
                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-file"></i> Enter Registration Code
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->

                    <div>
                        <!-- /.row -->
                        <?php
                        require ("./public_html/php/loginsec/db.inc.php");

                        $link = mysqli_connect("localhost", $benutzer, $passwort);
                        mysqli_select_db($link, $dbname);
                        $compAbfrage = "select comp_ID, comp_name from tbl_competition";
                        $compErgebnis = mysqli_query($link, $compAbfrage) or die(mysqli_error());


                        while ($compZeile = mysqli_fetch_array($compErgebnis, MYSQLI_ASSOC)) {
                            $comp_ID = $compZeile['comp_ID'];


                            echo "<div class=\"col-lg-6 col-md-6 col-sm-6\">";
                            echo"<div class=\"panel panel-default\">";
                            echo"<div class=\"panel-body\">";


                
                            echo "<h4 class=\"group inner list-group-item-heading\"><b>" .
                            $compZeile['comp_name'] . "</b></h4>";
                            echo "<img class=\"group list-group-image\"  alt=\"\"  />";


                            echo "<p class=\"group inner list-group-item-text\">Beschreibung</p>";
                            echo "</br>";

                            echo "<form name =\"formRegCodeEnter\" role=\"form\" onsubmit=\"return mySubmitRegCode()\">
                                                            <div class=\"form-group\">
                                                            <label>Code</label>
                                                            <input <type=\"password\" id=\"regcode".$comp_ID."\"  class=\"form-control input-lg\">
                                                            </div>";

                            $link = mysqli_connect("localhost", $benutzer, $passwort);
                            mysqli_select_db($link, $dbname);
                            $DivAbfrage = "select div_ID, div_name from tbl_division where fk_comp_ID = " . $comp_ID;
                            $DivErgebnis = mysqli_query($link, $DivAbfrage) or die(mysqli_error());


                            echo "<div class=\"form-group\">
                                 <label>Select Division</label><br>";
                            while ($DivZeile = mysqli_fetch_array($DivErgebnis, MYSQLI_ASSOC)) {

                                $div_id = $DivZeile['div_ID'];
                                $div_name = $DivZeile['div_name'];



                                echo "<label class=\"radio-inline\">
                                            <input type=\"radio\" name=\"Division".$comp_ID."\"  value=\"$div_id\" checked> $div_name
                                        </label>";
                            }

                            echo "</div>";
                        echo "<div id=\"msg" .$comp_ID. "\">

                                                                 </div>
                                                            <button type=\"submit\" onclick= \"comp_ID=$comp_ID\" class=\"btn btn-custom-red btn-lg\" >Submit</button>
                                                        </form>";




                            echo"</div>";
                            echo"</div>";
                            echo "</div>";
                        }



                        mysqli_close($link);
                        ?>                    







                    </div>
                </div>
                <!-- /.container-fluid -->


            </div>
            <!-- /#page-wrapper -->


        </div>
        <!-- /#wrapper -->




    </body>

</html>
