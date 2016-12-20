<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
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
        $div_id=array();



        foreach ($pdo->query($sqlseldiv) as $row) {
              array_push($anzDiv, $row['anzdiv']);
            array_push($div_name, $row['div_name']);
            array_push($div_id, $row['div_ID']);


            // echo $div_name;
            //$anzDiv++;
        }
        //  echo end($anzDiv);
       
        $anzdiv = count($anzDiv);
        
        
        //anzevents ermitteln
        
        
        
        
        
        //EVENT LADEN
        
        
        for ($i = 0; $i < $anzdiv; $i++) {
       $divID= $div_id[$i];     
            
       

       $sqlselevt = "SELECT * , count(fk_div_ID) as anzevt FROM `tbl_event` as a\n"
     . " INNER JOIN `tbl_division` as b\n"
     . " on a.fk_div_ID=b.div_ID\n"
     . " INNER JOIN `tbl_competition` as c\n"
     . " on b.fk_comp_ID=c.comp_ID\n"
     . " where b.div_ID=".$divID." \n"
     . " group by evt_ID";
               

          $anzevt = "anzevent";
        ${$anzevt.$i} = array();



        foreach ($pdo->query($sqlselevt) as $row) {
              array_push(${$anzevt.$i}, $row['anzevt']);
           


        }
         //echo ${$anzevt.$i}[0];   
        // echo $anzevent1[0]; 
        // echo $anzdiv;
         //echo $divID;
        //$anzdiv = count($anzDiv);
                 }
              
        ?>
    </body>
</html>
