<?php
session_start();

if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    $_SESSION['visited'] = true;
} else {
    echo "Du hast diese Seite zuvor schon aufgerufen";
}
?>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>SB Admin - Bootstrap Admin Template</title>

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
    $(function() {
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


	<h2>Example 1</h2>
	Color: <input class= input-lg value="ab2567">



	<h2>Example 2</h2>

	<button class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}">
		Pick text color
	</button>

	HEX value: <input id="chosen-value" value="000000">

	<script>
	function setTextColor(picker) {
		document.getElementsByTagName('body')[0].style.color = '#' + picker.toString()
	}
	</script>



                            <div id="cp2" class="input-group colorpicker-component">
                                <input type="text" value="#00AABB" class="form-control" />
                                <span class="input-group-addon"><i></i></span>
                            </div>

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <h2 class="page-header">
                                Styles
                            </h2>
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
        
        <script src="js/colorpicker/jscolor.js"></script>
    </body>

</html>
