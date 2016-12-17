<?php
session_start();
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
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
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


            function onSelectDivision()
            {

                var div_ID = 'div_ID=' + document.getElementById("selDiv").options[document.getElementById("selDiv").selectedIndex].value;


                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelWods.php",
                    cache: false,
                    data: div_ID,
                    success: function (html)
                    {
                        $('#wods').html(html);
                    },
                    error: function (html)
                    {

                        alert('error');
                    }

                }
                );

                return false;

            }

            function onSelectWod(i_wod_ID, i_div_ID)
            {

                var wod_ID = 'wod_ID=' + i_wod_ID;
                var div_ID = '&div_ID=' + i_div_ID;
                var all = wod_ID + div_ID;


                $.ajax({
                    type: "POST",
                    url: "ScoreboardViewSelResults.php",
                    cache: false,
                    data: all,
                    success: function (html)
                    {
                        $('#result').html(html);
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
                    <div class="col-lg-12"><div class="container">

                            <?php
                            include 'Database.php';

                            $pdo = Database::connect();

                            $compID = $_GET['comp_ID'];

                            $sql = "SELECT comp_name from tbl_competition where comp_id = $compID";


                            foreach ($pdo->query($sql) as $row) {
                                echo "<h2>Results: " . $row['comp_name'] . "</h2>";
                            }
                            ?>

                            <!--Renato  -->
                            <form class="form-horizontal"  method="post"> 

                                <div class = "form-group col-lg-6 col-md-6" >

                                    <select class = "form-control" id = "selDiv" onChange="onSelectDivision();">
                                        <option value="0">Select Division</option>

                                        <?php
                                        $sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

                                        foreach ($pdo->query($sql) as $row) {


                                            echo "<option value=" . $row['div_ID'] . ">" . $row['div_name'] . "</option>";
                                        }
                                        ?>


                                    </select>
                                </div>


                            </form>
                            <br>
                            <div id ="wods" class="col-lg-12 col-md-12"></div>
                            <br>
                            <table class="table table-hover col-lg-12 col-md-12" id ="result" ></table>



                        </div>       



                    </div>
                </div>


                <!-- /.row -->

            </div>
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
