<?php
session_start();

if ($_SESSION['eingeloggt'] == false) {

    header("Location: public_html/ChampScoreIndex.php");
    exit();
}

if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    $_SESSION['visited'] = true;
} else {
    /* echo "Du hast diese Seite zuvor schon aufgerufen"; */
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
                                Add Score <small>name</small>

                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <i class="fa fa-fire"></i>  <a href="organizer.php">Organizer</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-pencil"></i> Add Score
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">


                            <div class="container">

                                <?php
                                include 'Database.php';

                                $pdo = Database::connect();

                                $compID = $_GET['comp_ID'];
                                $sql = "SELECT `comp_name` FROM `tbl_competition` where comp_id = $compID";

                                foreach ($pdo->query($sql) as $row) {
                                    echo "<h2>Select Division: " . $row['comp_name'] . "</h2>";
                                }
                                ?>


                                <form class="form-horizontal" action="competitionAddScore.php?comp_ID=<?php echo $compID ?>" method="post"> 
                                    <table class="table table-hover">
                                        <tr>
<?php
$sql = "SELECT div_name, div_ID FROM `tbl_division` where fk_comp_id = $compID";

foreach ($pdo->query($sql) as $row) {
    echo

    "<th><button type='submit' value='" . $row['div_ID'] . "' id='" . $row['div_ID'] . "' name='divselectbasic' class='btn btn-custom-red btn-lg'>" . $row['div_name'] . "  </button>  </th> ";
}
?>

                                        </tr>
                                    </table>
                                </form>

                            </div>       
                                            <?php
                                            if (isset($_POST['divselectbasic'])) {
                                                ?>


                                <div class="container">
    <?php
    $divison = $_POST['divselectbasic'];

    $sql = "SELECT `div_name` FROM `tbl_division` where div_id = $divison";

    foreach ($pdo->query($sql) as $row) {
        echo "<h2>Input Results Divison: " . $row['div_name'] . "</h2>";
    }
    ?>

                                    <p>input or update the results</p> 

                                    <form  class="form-horizontal" action="update_result.php?comp_ID=<?php echo $compID?>" method="post">  
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Box</th>    
                                    <?php
                                    $wod_array = array();
                                    $wod_count = 1;

                                    //  $pdo = Database::connect();
                                    $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $divison";
                                    foreach ($pdo->query($sql) as $row) {
                                        echo
                                        "<th> " . $row['evt_name'] . " <br/> " . $row['wod_name'] . " </th> ";

                                        $wod_array[$wod_count] = $row['wod_ID'];

                                        $wod_count++;
                                    }
                                    ?>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                    <?php
//$sql = "select u.user_name as Name, u.user_box as Box,\n"
//    . "sum(if(fk_wod_ID=1,res_score,0)) as wod1,\n"
//    . "sum(if(fk_wod_ID=2,res_score,0)) as wod2,\n"
//    . "sum(if(fk_wod_ID=3,res_score,0)) as wod3,\n"
//    . "sum(if(fk_wod_ID=4,res_score,0)) as wod4,\n"
//    . "sum(if(fk_wod_ID=5,res_score,0)) as wod5\n"
//    . "from tbl_result r join tbl_user_division d \n"
//    . "on r.fk_user_div_ID = d.user_div_ID \n"
//    . "join tbl_user u on d.fk_user_ID = u.user_ID\n"
//    . "group by r.fk_user_div_ID";

                                                    $subsql = "";
                                                    for ($count1 = 1; $count1 < $wod_count; $count1++) {
                                                        $subsql = $subsql . ",\n sum(if(fk_wod_ID=" . $wod_array[$count1] . ",res_score,0)) as wod"
                                                                . $count1
                                                                . ", sum(if(r.fk_wod_ID=" . $wod_array[$count1] . ",r.res_ID,0)) as resID"
                                                                . $count1;
                                                    }


                                                    $sql = "select d.user_div_ID, u.user_name as Name, u.user_box as Box"
                                                            . $subsql
                                                            . "  from tbl_user u join tbl_user_division d on d.fk_user_ID = u.user_ID"
                                                            . " left join tbl_result r on r.fk_user_div_ID = d.user_div_ID "
                                                            . "  where d.fk_div_ID ="
                                                            . $divison . " group by Name";





                                                    foreach ($pdo->query($sql) as $row) {
                                                        echo "
      <tr>
        <td>" . $row['Name'] . "</td>
        <td> " . $row['Box'] . " </td>";
                                                        for ($count = 1; $count < $wod_count; $count++) {
                                                            $wodas = "wod" . $count;
                                                            $fieldID = $row["resID" . $count] . "X" . $row["user_div_ID"] . "X" . $wod_array[$count];


                                                            echo "    <td> <input id='" . $fieldID . "' name='" . $fieldID . "' type='text'  placeholder='score' "
                                                            . "value='" . $row[$wodas] . "'> </td>";
                                                        }


                                                        echo "   </tr>";
                                                    }

                                                    Database::disconnect();
                                                    ?>

                                            </tbody>
                                        </table>



                                        <button id="btn_save" name="btn_save" class="btn btn-custom-red btn-lg">Save</button>

                                    </form > 

                                </div>

                                                <?php
                                            }
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
