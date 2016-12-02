<?php
session_start();


if (!isset($_SESSION['visited'])) {
    echo "Du hast diese Seite noch nicht besucht";
    $_SESSION['visited'] = true;
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


                        <li>

                            <A HREF = loginsec/logout.php>Log out</A>
                        </li>
                        <li>
                            <A HREF = allScoreboards.php>All Scoreboards</A>
                        </li>
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

                <!-- Sidebar -->
                <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
                    <ul class="nav sidebar-nav">
                        <li class="sidebar-brand">

                            <p></p><span class="glyphicon glyphicon-cog"></span>

                        </li>
                        <li>
                                   <!--<p ></p><?php echo $_SESSION['benutzer']; ?>-->
                        </li>
                        <li>
                            <a href="person.php" data-toggle ="tooltip" data-placement="right" title="User"> <span class="glyphicon glyphicon-user"></span > User</a>
                        </li>
                        <li>
                            <a href="box.php"> <span class="glyphicon glyphicon-home"></span> Box</a>
                        </li>
                        <li>
                            <a href="scoreboard.php"><span class="glyphicon glyphicon-th-list"></span> Board</a>
                        </li>
                        <li>
                            <a href="reports.php"><span class="glyphicon glyphicon-stats"></span> Report</a>
                        </li>  



                        <!-- <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Works <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li class="dropdown-header">Dropdown heading</li>
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                          </ul>
                        
                        <li>
                            <a href="#">Services</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="https://twitter.com/maridlcrmn">Follow me</a>
                        </li></li>-->
                    </ul>
                </nav>
                <div id="page-content-wrapper">

                    <div class="container">

                        <h1><?php echo $_SESSION['benutzer']; ?></h1>

                        <div class="panel panel-default" style="opacity: .9">
                            <div class="panel-heading"><h2>Welcome</h2></div>
                            <div class="panel-body">
                                <!--
                                <form class="form-horizontal" >
                                  <div class="form-group">
                                    <label class="control-label col-xs-2" for="email">Email:</label>
                                    <div class="col-xs-1">
                                      <p class="form-control-static"><?php echo $_SESSION['benutzer']; ?></p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label col-sm-2" for="pwd">Password:</label>
                                    <div class="col-xs-4">
                                      <input type="password" class="form-control" id="pwd" placeholder="Enter password">
                                    </div>
                                  </div>
                                  
                                </form>
                                -->
                            </div>
                        </div>


                    </div>
                    <!-- <div id="page-content-wrapper">
                         <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                             <span class="hamb-top"></span>
                                     <span class="hamb-middle"></span>
                                             <span class="hamb-bottom"></span>
                         </button>
                         <div class="container">
                             <div class="row">
                                 <div class="col-lg-8 col-lg-offset-2">
                                     <h1>Fancy Toggle Sidebar Navigation</h1>
                                     <p>Bacon ipsum dolor sit amet tri-tip shoulder tenderloin shankle. Bresaola tail pancetta ball tip doner meatloaf corned beef. Kevin pastrami tri-tip prosciutto ham hock pork belly bacon pork loin salami pork chop shank corned beef tenderloin meatball cow. Pork bresaola meatloaf tongue, landjaeger tail andouille strip steak tenderloin sausage chicken tri-tip. Pastrami tri-tip kielbasa sausage porchetta pig sirloin boudin rump meatball andouille chuck tenderloin biltong shank </p>
                                     <p>Pig meatloaf bresaola, spare ribs venison short loin rump pork loin drumstick jowl meatball brisket. Landjaeger chicken fatback pork loin doner sirloin cow short ribs hamburger shoulder salami pastrami. Pork swine beef ribs t-bone flank filet mignon, ground round tongue. Tri-tip cow turducken shank beef shoulder bresaola tongue flank leberkas ball tip.</p>
                                     <p>Filet mignon brisket pancetta fatback short ribs short loin prosciutto jowl turducken biltong kevin pork chop pork beef ribs bresaola. Tongue beef ribs pastrami boudin. Chicken bresaola kielbasa strip steak biltong. Corned beef pork loin cow pig short ribs boudin bacon pork belly chicken andouille. Filet mignon flank turkey tongue. Turkey ball tip kielbasa pastrami flank tri-tip t-bone kevin landjaeger capicola tail fatback pork loin beef jerky.</p>
                                     <p>Chicken ham hock shankle, strip steak ground round meatball pork belly jowl pancetta sausage spare ribs. Pork loin cow salami pork belly. Tri-tip pork loin sausage jerky prosciutto t-bone bresaola frankfurter sirloin pork chop ribeye corned beef chuck. Short loin hamburger tenderloin, landjaeger venison porchetta strip steak turducken pancetta beef cow leberkas sausage beef ribs. Shoulder ham jerky kielbasa. Pig doner short loin pork chop. Short ribs frankfurter rump meatloaf.</p>
                                     <p>Filet mignon biltong chuck pork belly, corned beef ground round ribeye short loin rump swine. Hamburger drumstick turkey, shank rump biltong pork loin jowl sausage chicken. Rump pork belly fatback ball tip swine doner pig. Salami jerky cow, boudin pork chop sausage tongue andouille turkey.</p>                         
                                 </div>
                             </div>
                         </div>
                     </div>
                     
                    <!-- /#page-content-wrapper --> 


                </div>


        </header>
        <!-- Menu Toggle Script-->

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>


        <script type="text/javaScript">
            $("#menu-toggle").click( function(e){
            e.preventDefault();
            $("#wrapper").toggleClass("menuDisplayed");
            });


            $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
            });

        </script>


    </body>
</html>