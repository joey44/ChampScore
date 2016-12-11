<?php
session_start();



if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    /* $_SESSION['visited'] = true; */
} else {
    /* echo "Du hast diese Seite zuvor schon aufgerufen"; */
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

                            <form class="form-horizontal" action="ScoreboardView.php?comp_ID=<?php echo $compID ?>" method="post"> 
                                <table class="table table-hover">
                                    <tr>
                                        <?php
                                        $sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

                                        foreach ($pdo->query($sql) as $row) {
                                            echo

                                            "<th><button type='submit' value='" . $row['div_ID'] . "' id='" . $row['div_ID'] . "' name='divselectbasic' class=' btn btn-custom-red btn-lg'>" . $row['div_name'] . "  </button>  </th> ";
                                        }
                                        ?>

                                    </tr>
                                </table>
                            </form>

                        </div>       

                        <?php
                        if (isset($_POST['divselectbasic']) || isset($_POST['wod_button'])) {
                            ?>

                            <div class="container">

                                <form class="form-horizontal" action="ScoreboardView.php?comp_ID=<?php echo $compID ?>" method="post"> 
                                    <table class="table table-hover">
                                        <tr>


                                            <?php
                                            $wod_array = array();
                                            $wod_count = 1;

                                            if (isset($_POST['wod_button'])) {
                                                $dataString = $_POST['wod_button'];
                                                list ($divison, $selected_wod) = explode('X', $dataString);
                                            } else {
                                                $divison = $_POST['divselectbasic'];
                                            }

                                            echo "<th><button type='submit' value='" . $divison . "Xoverall123' id='overall' name='wod_button' class='btn btn-custom-red btn-lg'>overall</button>  </th> ";


                                            //      include 'Database.php';
                                            //      $pdo = Database::connect();
                                            $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $divison";
                                            foreach ($pdo->query($sql) as $row) {
                                                echo

                                                "<th><button type='submit' value='" . $divison . "X" . $row['wod_ID'] . "' id='" . $row['wod_ID'] . "' name='wod_button' class='btn btn-custom-red btn-lg'>" . $row['evt_name'] . " <br/> " . $row['wod_name'] . " </button>  </th> ";


                                                $wod_array[$wod_count] = $row['wod_ID'];

                                                $wod_count++;
                                            }
                                            ?>

                                        </tr>
                                    </table>
                                </form>
                                <?php
                                if (isset($_POST['wod_button'])) {


                                    if ($selected_wod == "overall123") {

                                        echo "<p>Overall Ranking </p>";
                                    } else {

                                        $sql = "SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =" . $selected_wod;

                                        foreach ($pdo->query($sql) as $row) {
                                            echo "<p>" . $row['Description'] . "</p>";
                                        }
                                    }
                                    ?>

                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Box</th>
                                                <th>Points</th>
                                            </tr>
                                        </thead>
                                        <tbody>


                                            <?php
                                            if ($selected_wod == "overall123") {

                                                $sql = "SELECT u.user_name as Name, u.user_box as Box, SUM(r.res_score) as Punkte FROM tbl_user u inner \n"
                                                        . " join tbl_user_division d\n"
                                                        . " on u.user_ID = d.fk_user_ID inner \n"
                                                        . " join tbl_result r on d.user_div_ID = r.fk_user_div_ID \n"
                                                        . " WHERE d.fk_div_ID = " . $divison . " GROUP by Name ORDER by Punkte ASC";



                                                foreach ($pdo->query($sql) as $row) {
                                                    echo "
      <tr>
        <td>" . $row['Name'] . "</td>
        <td> " . $row['Box'] . " </td>
        <td> " . $row['Punkte'] . " </td>
      </tr>";
                                                }
                                            } else {



                                                $sql = "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
                                                        . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID where r.fk_wod_ID =" . $selected_wod . " ORDER BY Punkte ASC";


                                                foreach ($pdo->query($sql) as $row) {
                                                    echo "
      <tr>
        <td>" . $row['Name'] . "</td>
        <td> " . $row['Box'] . " </td>
        <td> " . $row['Punkte'] . " </td>
      </tr>";
                                                }
                                            }

                                            Database::disconnect();
                                            ?>

                                        </tbody>
                                    </table>

                                    <form  action="rangliste_pdf.php" method="post">  

                                        <button type="submit" value="<?php echo $selected_wod ?>" id="btn_pdf" name="btn_pdf" class="btn btn-custom-red btn-lg">PDF Export</button>

                                    </form > 

                                    <?php
                                }
                                ?>
                            </div>

                            <?php
                        }
                        ?>   </div>
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
