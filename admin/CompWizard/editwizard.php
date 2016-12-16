<html>
    <head>
        <title>Registration</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link rel="stylesheet" href="Wizard.css" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="Wizard.js"></script>
        <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="../prettify.css" rel="stylesheet">
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap-wizard/1.2/jquery.bootstrap.wizard.min.js"></script>
        <link rel="stylesheet" href="css/wizard.css" type="text/css">
    </head>
    <body>

        <?php
        //COMPETITION LADEN
        include 'Database.php';
        $pdo = Database::connect();

        $sqlsel = "SELECT * FROM `tbl_competition`\n"
                . "where comp_ID=22";

        // $compID = 22;
        $comp_name;
        $comp_regcode;
        $comp_date;

        foreach ($pdo->query($sqlsel) as $row) {
            $comp_name = $row['comp_name'];
            $comp_date = $row['comp_date'];
            $comp_regcode = $row['comp_regcode'];
        }


        //DIVISION LADEN

        $sqlseldiv = "SELECT * , count(fk_comp_ID) as anzdiv FROM `tbl_division` as a\n"
                . " INNER JOIN `tbl_competition` as b\n"
                . " on a.fk_comp_ID=b.comp_ID\n"
                . " group by div_ID";

        $anzDiv = array();
        $div_name = array();



        foreach ($pdo->query($sqlseldiv) as $row) {
            array_push($anzDiv, $row['anzdiv']);
            array_push($div_name, $row['div_name']);

            // echo $div_name;
            //$anzDiv++;
        }
        //  echo end($anzDiv);
        // echo end($div_name);
        $anzdiv = count($anzDiv);
        ?>



        <div class="container">
            <div class="row">
                <section>
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">

                                <li role="presentation" class="active">
                                    <a href="#persInfo" data-toggle="tab" aria-controls="persInfo" role="tab" title="Person">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-home"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#boxInfo" data-toggle="tab" aria-controls="boxInfo" role="tab" title="Box">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-menu-right"></i>
                                        </span>
                                    </a>
                                </li>
                                <li role="presentation" class="disabled">
                                    <a href="#compInfo" data-toggle="tab" aria-controls="compInfo" role="tab" title="Competition" id="tabWod">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon glyphicon-menu-right"></i>
                                        </span>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                        <span class="round-tab">
                                            <i class="glyphicon glyphicon-ok"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <form role="form">
                            <div class="tab-content">
                                <div class="tab-pane active" role="tabpanel" id="persInfo">
                                    <div class="persInfo">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Competition Name</label>
                                                <input type="text" class="form-control" id="compName" placeholder="Competition Name" value=<?php echo $comp_name ?>>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="exampleInputEmail1">Registration Code for athletes</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Registration Code for athletes" value=<?php echo $comp_regcode ?>>
                                            </div>
                                        </div>

                                        <div class="row">


                                            <div class="col-md-6">

                                                <label for="exampleInputEmail1">Competition Date</label>
                                                <input type="date" class="form-control" name="compDate" value=<?php echo $comp_date ?>>

                                            </div>
                                        </div>
                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-primary next-step">Next</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="boxInfo">
                                    <div class="boxInfo">






                                        <script>
                                            $(document).ready(function () {

                                                $("#nextWod").click(function () {


                                                    var sel_valueDiv = $('#selectDiv option:selected').val();



                                                    for (var i = 1; i <= sel_valueDiv; i++) {
                                                        $("#Div" + i).empty();
                                                        (function (i) {
                                                            var sel_valueEv = $('#selectEvent' + i + ' option:selected').val();
                                                            var $this = $("#nameDiv_" + i);
                                                            $("#Div" + i).append($("<h2/>").text($this.val() + " (Division " + i + ")"));


                                                            for (var a = 1; a <= sel_valueEv; a++) {

                                                                (function (a) {
                                                                    var $this = $("#event_" + a + i);
                                                                    window.setTimeout(function () {
                                                                        $("#Div" + i).append($("<div/>", {
                                                                            id: 'DivE' + a + i
                                                                        }));
                                                                        $("#DivE" + a + i).append(($this.val() + " (Event " + a + ")"),
                                                                                $("<br/>"),
                                                                                $("<label/>").text("Number of Wods"),
                                                                                $("<select/>", {
                                                                                    class: 'form-control',
                                                                                    id: 'selectWod' + a + i,
                                                                                    name: 'selWod' + a + i



                                                                                }), $("<br/>"));
                                                                        $("#selectWod" + a + i).append($("<option/>", {
                                                                            text: '0',
                                                                            value: '0'
                                                                        }),
                                                                                $("<option/>", {
                                                                                    text: '1',
                                                                                    value: '1'
                                                                                }),
                                                                                $("<option/>", {
                                                                                    text: '2',
                                                                                    value: '2'
                                                                                }),
                                                                                $("<option/>", {
                                                                                    text: '3',
                                                                                    value: '3'
                                                                                }),
                                                                                $("<option/>", {
                                                                                    text: '4',
                                                                                    value: '4'
                                                                                })


                                                                                );
                                                                    }, 0);

                                                                })(a);
                                                            }

                                                        })(i);

                                                    }





                                                    //$("#Div1").text(sel_value);


                                                });

                                                $("#tabWod").click(function (e) {
                                                    var sel_valueDiv = $('#selectDiv option:selected').val();

                                                    //$("#Div1").text(sel_valueDiv);


                                                });



                                                $('#selectDiv').change(function () {
                                                    var sel_value = $('#selectDiv option:selected').val();
                                                    if (sel_value == 0) {


                                                        $("#divDivison1").empty(); // Resetting Form
                                                        $("#divDivison2").empty(); // Resetting Form
                                                        $("#divDivison3").empty(); // Resetting Form
                                                        $("#divDivison4").empty(); // Resetting Form
                                                        $("#divDivison1").removeAttr("style");
                                                        $("#divDivison2").removeAttr("style");
                                                        $("#divDivison3").removeAttr("style");
                                                        $("#divDivison4").removeAttr("style");
                                                        /* $("#Div1").empty(); // Resetting Form
                                                         $("#Div2").empty(); // Resetting Form
                                                         $("#Div3").empty(); // Resetting Form
                                                         $("#Div4").empty(); // Resetting Form
                                                         $("#Div1").removeAttr("style");
                                                         $("#Div2").removeAttr("style");
                                                         $("#Div3").removeAttr("style");
                                                         $("#Div4").removeAttr("style");
                                                         */
                                                    } else {

                                                        $("#divDivison1").empty(); // Resetting Form
                                                        $("#divDivison2").empty(); // Resetting Form
                                                        $("#divDivison3").empty(); // Resetting Form
                                                        $("#divDivison4").empty(); // Resetting Form
                                                        $("#divDivison1").removeAttr("style");
                                                        $("#divDivison2").removeAttr("style");
                                                        $("#divDivison3").removeAttr("style");
                                                        $("#divDivison4").removeAttr("style");

                                                        /*$("#Div1").empty(); // Resetting Form
                                                         $("#Div2").empty(); // Resetting Form
                                                         $("#Div3").empty(); // Resetting Form
                                                         $("#Div4").empty(); // Resetting Form
                                                         $("#Div1").removeAttr("style");
                                                         $("#Div2").removeAttr("style");
                                                         $("#Div3").removeAttr("style");
                                                         $("#Div4").removeAttr("style");
                                                         */
                                                        create(sel_value);
                                                    }
                                                });
                                                function create(sel_value) {
                                                    for (var i = 1; i <= sel_value; i++) {
                                                        (function (i) {
                                                            document.getElementById('divDivison' + i).setAttribute('style', 'border:0.5px solid grey; ');
                                                            document.getElementById('Div' + i).setAttribute('style', 'border:0.5px solid grey; ');
                                                            $("#divDivison" + i).append(
                                                                    $("<h1/>").text("Division " + i), $("<input/>", {
                                                                class: 'form-control',
                                                                type: 'text',
                                                                id: "nameDiv_" + i,
                                                                name: 'NumbDiv_' + i
                                                            }),
                                                                    $('<br/>'),
                                                                    $("<label/>").text("Number of Events"),
                                                                    $("<select/>", {
                                                                        class: 'form-control',
                                                                        id: 'selectEvent' + i,
                                                                        name: 'selEvent' + i

                                                                    }),
                                                                    $("<div/>", {

                                                                        id: 'divEvent' + i}),
                                                                    $("<br/>"), $("<br/>")
                                                                    );

                                                            /*     $("#nameDiv_" + i).focusin(function () {
                                                             var $this = $("#nameDiv_" + i);
                                                             window.setTimeout(function () {
                                                             $("#Div" + i).empty();
                                                             }, 0);
                                                             });
                                                             */

                                                            /*    $("#nameDiv_" + i).focusout(function () {
                                                             var $this = $("#nameDiv_" + i);
                                                             window.setTimeout(function () {
                                                             $("#Div" + i).append($("<h2/>").text($this.val() + i + " (Division " + i + ")"));
                                                             }, 0);
                                                             });
                                                             */

                                                            $("#selectEvent" + i).append($("<option/>", {
                                                                text: '0',
                                                                value: '0'
                                                            }),
                                                                    $("<option/>", {
                                                                        text: '1',
                                                                        value: '1'
                                                                    }),
                                                                    $("<option/>", {
                                                                        text: '2',
                                                                        value: '2'
                                                                    }),
                                                                    $("<option/>", {
                                                                        text: '3',
                                                                        value: '3'
                                                                    }),
                                                                    $("<option/>", {
                                                                        text: '4',
                                                                        value: '4'
                                                                    })


                                                                    );
                                                        })(i);
                                                    }

                                                }




                                                $('#selectDiv').change(function () {
                                                    var sel_value = $('#selectDiv option:selected').val();
                                                    for (var i = 1; i <= sel_value; i++) {



                                                        (function (i) {


                                                            $('#numbDiv').on('change', '#selectEvent' + i, function () {

                                                                var sel_value1 = $('#selectEvent' + i + ' option:selected').val();
                                                                if (sel_value1 == 0) {
                                                                    $("#divEvent" + i).empty(); // Resetting Form
                                                                    /*  $('#DivE1' + i).empty();
                                                                     $('#DivE2' + i).empty();
                                                                     $('#DivE3' + i).empty();
                                                                     $('#DivE4' + i).empty();
                                                                     */
                                                                } else {

                                                                    $("#divEvent" + i).empty(); //Resetting Form
                                                                    // $("#Div" + i).empty();
                                                                    /*  $('#DivE1' + i).empty();
                                                                     $('#DivE2' + i).empty();
                                                                     $('#DivE3' + i).empty();
                                                                     $('#DivE4' + i).empty();
                                                                     */
                                                                    create1(sel_value1);
                                                                }

                                                                function create1(sel_value1) {

                                                                    for (var a = 1; a <= sel_value1; a++) {


                                                                        (function (a) {
                                                                            $("#divEvent" + i).append($("<label/>").text("Event " + a + i),
                                                                                    $("<input/>", {
                                                                                        class: 'form-control',
                                                                                        type: 'text',
                                                                                        id: "event_" + a + i,
                                                                                        name: 'NumbEvent_' + a + i
                                                                                    }));
                                                                            /*       $("#event_" + a + i).focusin(function () {
                                                                             var $this = $("#event_" + a + i);
                                                                             window.setTimeout(function () {
                                                                             $("#DivE" + a + i).empty();
                                                                             }, 0);
                                                                             });
                                                                             */
                                                                            /*   $("#event_" + a + i).focusout(function () {
                                                                             var $this = $("#event_" + a + i);
                                                                             window.setTimeout(function () {
                                                                             $("#Div" + i).append($("<div/>", {
                                                                             id: 'DivE' + a + i
                                                                             }));
                                                                             $("#DivE" + a + i).append(($this.val() + " (Event " + a + ")"),
                                                                             $("<br/>"),
                                                                             $("<label/>").text("Number of Wods"),
                                                                             $("<select/>", {
                                                                             class: 'form-control',
                                                                             id: 'selectWod' + a + i,
                                                                             name: 'selWod' + a + i
                                                                             
                                                                             
                                                                             
                                                                             }), $("<br/>"));
                                                                             $("#selectWod" + a + i).append($("<option/>", {
                                                                             text: '0',
                                                                             value: '0'
                                                                             }),
                                                                             $("<option/>", {
                                                                             text: '1',
                                                                             value: '1'
                                                                             }),
                                                                             $("<option/>", {
                                                                             text: '2',
                                                                             value: '2'
                                                                             }),
                                                                             $("<option/>", {
                                                                             text: '3',
                                                                             value: '3'
                                                                             }),
                                                                             $("<option/>", {
                                                                             text: '4',
                                                                             value: '4'
                                                                             })
                                                                             
                                                                             
                                                                             );
                                                                             }, 0);
                                                                             });
                                                                             */
                                                                        })(a);
                                                                    }
                                                                }

                                                            });
                                                        })(i);
                                                    }

                                                });
                                                $('#selectDiv').change(function () {
                                                    var sel_value = $('#selectDiv option:selected').val();
                                                    for (var i = 1; i <= sel_value; i++) {



                                                        (function (i) {


                                                            $('#numbDiv').on('change', '#selectEvent' + i, function () {

                                                                var sel_value1 = $('#selectEvent' + i + ' option:selected').val();
                                                                for (var a = 1; a <= sel_value1; a++) {

                                                                    (function (a) {
                                                                        $('#divmaster').on('change', '#selectWod' + a + i, function () {


                                                                            var sel_value2 = $('#selectWod' + a + i + ' option:selected').val();
                                                                            //var sel_value2 =2;
                                                                            if (sel_value2 == 0) {
                                                                                /* $("#divEvent" + i).empty(); // Resetting Form
                                                                                 $('#DivE1' + i).empty();
                                                                                 $('#DivE2' + i).empty();
                                                                                 $('#DivE3' + i).empty();
                                                                                 $('#DivE4' + i).empty();
                                                                                 */

                                                                            } else {
                                                                                /*  $("#divEvent" + i).empty(); //Resetting Form
                                                                                 // $("#Div" + i).empty();
                                                                                 $('#DivE1' + i).empty();
                                                                                 $('#DivE2' + i).empty();
                                                                                 $('#DivE3' + i).empty();
                                                                                 $('#DivE4' + i).empty();
                                                                                 */

                                                                                create2(sel_value2);

                                                                            }
                                                                            function create2(sel_value2) {

                                                                                for (var c = 1; c <= sel_value2; c++) {


                                                                                    (function (c) {
                                                                                        $("#DivE" + a + i).append($("<div/>", {
                                                                                            id: 'divWod' + a + i + c
                                                                                        }));

                                                                                        $("#divWod" + a + i + c).append($("<label/>").text("Name Wod " + c),
                                                                                                $("<br/>"),
                                                                                                $("<input/>", {
                                                                                                    class: 'form-control',
                                                                                                    type: 'text',
                                                                                                    id: 'inputWod' + a + i + c
                                                                                                }
                                                                                                ), $("<label/>").text("Description of Wod" + 1),
                                                                                                $("<textarea/>", {
                                                                                                    class: 'form-control',
                                                                                                    id: 'textWod' + a + i + c
                                                                                                }),
                                                                                                $("<br/>")

                                                                                                );


                                                                                    })(c);
                                                                                }
                                                                            }




                                                                        });
                                                                    })(a);
                                                                }


                                                            });
                                                        })(i);
                                                    }

                                                });
                                            });
                                        </script>



                                        <div class="col-md-12">
                                            <label for="exampleSelect1">Number of Divisions</label>
                                            <select class="form-control" id="selectDiv" name="select" >
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>

                                            <br/>
                                        </div>

                                        <script>
                                             $(document).ready(function () {
                                            var anzDiv = <?php echo $anzdiv ?>;
                                             $('#selectDiv').val(anzDiv);
                                           
                                           
                                            
                                            for (var d = 1; d <= anzDiv; d++) {
                                                        (function (d) {
                                                            document.getElementById('divDivison' + d).setAttribute('style', 'border:0.5px solid grey; ');
                                                            document.getElementById('Div' + d).setAttribute('style', 'border:0.5px solid grey; ');
                                                            $("#divDivison" + d).append(
                                                                    $("<h1/>").text("Division " + d), $("<input/>", {
                                                                class: 'form-control',
                                                                type: 'text',
                                                                id: "nameDiv_" + d,
                                                                name: 'NumbDiv_' + d
                                                            }),
                                                                    $('<br/>'),
                                                                    $("<label/>").text("Number of Events"),
                                                                    $("<select/>", {
                                                                        class: 'form-control',
                                                                        id: 'selectEvent' + d,
                                                                        name: 'selEvent' + d

                                                                    }),
                                                                    $("<div/>", {

                                                                        id: 'divEvent' + d}),
                                                                    $("<br/>"), $("<br/>")
                                                                    );

                                                           
                                                        })(d);
                                                    }
                                      
                                            
                                            });



                                        </script>

                                        <div  id="numbDiv" >
                                            <div class="row">

                                                <div class="col-md-6" id="divDivison1" > 


                                                </div>
                                                <div class="col-md-6" id="divDivison2"  >

                                                </div>
                                            </div> 

                                            <div class="row">

                                                <div class="col-md-6" id="divDivison3"  >

                                                </div>
                                                <div class="col-md-6" id="divDivison4"  >

                                                </div>
                                            </div> 



                                        </div>
                                        <br/>
                                    </div>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <br/>
                                    <ul class="list-inline pull-right">

                                        <li><button type="button" class="btn btn-default prev-step">Back</button></li>
                                        <li><button type="button" class="btn btn-primary next-step" id="nextWod">Next</button></li>
                                    </ul>
                                </div>



                                <div class="tab-pane" role="tabpanel" id="compInfo">
                                    <div class="compInfo">

                                        <div id="divmaster">
                                            <div class="row">

                                                <div class="col-md-6" id="Div1" >

                                                </div>
                                                <div class="col-md-6" id="Div2" >

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6" id="Div3" >


                                                </div>
                                                <div class="col-md-6" id="Div4" > 

                                                </div>
                                            </div>
                                        </div>




                                    </div>
                                    <ul class="list-inline pull-right">
                                        <li><button type="button" class="btn btn-default prev-step">Back</button></li>
                                        <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                        <li><button type="button" class="btn btn-primary btn-info-full next-step">Next</button></li>
                                    </ul>
                                </div>
                                <div class="tab-pane" role="tabpanel" id="complete">
                                    <div class="step44">
                                        <h5>Completed</h5>

                                        <ul class="list-inline pull-right">
                                            <li><button type="button" class="btn btn-default prev-step">Back</button></li>
                                            <!--<li><button type="button" class="btn btn-default next-step">Skip</button></li>-->
                                            <li><button type="button" class="btn btn-primary btn-info-full next-step">Finish</button></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
        <script type="text/javascript" src="js/wizard.js"></script>
    </body>
</html>