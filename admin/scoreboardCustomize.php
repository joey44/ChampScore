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

        <script>
            $(function () {
                $('#cp2').colorpicker();
            });
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
                                Customize Scoreboard

                            </h1>
                            <ol class="breadcrumb">
                                <li>
                                    <i class="fa fa-dashboard"></i>  <a href="index.php">Home</a>
                                </li>
                                <li>
                                    <i class="fa fa-fire"></i>  <a href="organizer.php">Organizer</a>
                                </li>
                                <li class="active">
                                    <i class="fa fa-th-list"></i> Customize Scoreboard
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                                Logo
                            </h2>



                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                                Colors
                            </h2>



                            <!--<h2>Example 1</h2>
                            Color: <input class=jscolor input-lg value="ab2567">
                            -->


                            <form name="formScoreboardCustomize" action="scoreboardPreview.php"  method="POST" class="sa-innate-form">


                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p>Score Color:   <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-score', onFineChange:'setTextColorScore(this)'} btn btn-default btn-md">

                                                </button></p>

                                            <p>HEX value: <input  class="form-control" name="colorScore" id="chosen-value-score" value="000000">
                                            </p>
                                            <script>
                                                function setTextColorScore(picker) {
                                                    $("#FCScore").css('color', '#' + picker.toString());
                                                    document.getElementsByName('FCScore')[0].style.color = '#' + picker.toString()
                                                }
                                            </script>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p>Name Color   <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-name', onFineChange:'setTextColorName(this)'} btn btn-default btn-md">

                                                </button></p>

                                            HEX value: <input  class="form-control" name="colorName" id="chosen-value-name" value="000000">

                                            <script>
                                                function setTextColorName(picker) {
                                                    $("#FCName").css('color', '#' + picker.toString());
                                                }
                                            </script>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p>Ranking Color   <button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-place', onFineChange:'setTextColorPlace(this)'} btn btn-default btn-md">

                                                </button></p>

                                            HEX value: <input  class="form-control" name="colorRanking" id="chosen-value-place"  value="000000">

                                            <script>
                                                function setTextColorPlace(picker) {
                                                    $("#FCPlace").css('color', '#' + picker.toString());
                                                }
                                            </script>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <p>Background Color<button style="width: 25px ;height: 25px" class="jscolor {valueElement:'chosen-value-back', onFineChange:'setTextColorBack(this)'} btn btn-default btn-md">

                                                </button></p>

                                            HEX value: <input  class="form-control" name="colorRanking" id="chosen-value-back" value="000000">

                                            <script>
                                                function setTextColorBack(picker) {
                                                    $("#FCBack").css('background-color', '#' + picker.toString());
                                                    //document.getElementsByName('FCBack')[0].style.color = '#' + picker.toString()
                                                    $('#FCBack').css({
                                                        background: "linear-gradient(to bottom, #" + picker.toString() + "   0%,#" + picker.toString() + " 60%, #" + picker.toString() + " 100%)"
                                                    });

                                                }
                                            </script>
                                        </div>
                                    </div>



                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <label>Preview</label>
                                            <div id="panel" class="panel panel-primary">


                                                <div class="panel-body" id="FCBack">

                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="text-align: left">

                                                        <h2 id="FCPlace">2</h2>
                                                    </div>

                                                    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="text-align: left" >

                                                        <h2 id="FCName">Name</h2>
                                                    </div>

                                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="text-align: right">

                                                        <h2 id="FCScore">10:24</h2>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-custom-red btn-lg" name="submit" >Preview</button><br><br><br></div>

                                </div>
                            </form>
                        </div>




                    </div>

                    <!-- /#page-wrapper -->

                </div>
                <!-- /#wrapper -->

                <!-- jQuery -->
                <script src="js/jquery.js"></script>

                <!-- Bootstrap Core JavaScript -->
                <script src="js/bootstrap.min.js"></script>

                <script src="js/colorpicker/jscolor.js"></script>
                </body>

                </html>
