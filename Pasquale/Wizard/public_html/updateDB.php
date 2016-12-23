
<?php

include 'Database.php';
$pdo = Database::connect();

var_dump($_POST);


$sqlseldiv = "SELECT * , count(fk_comp_ID) as anzdiv FROM `tbl_division` as a\n"
        . " INNER JOIN `tbl_competition` as b\n"
        . " on a.fk_comp_ID=b.comp_ID\n"
        . " group by div_ID\n"
        . " order by div_ID";

$div_ID = array();
$evt_ID = array();
$wod_ID = array();



foreach ($pdo->query($sqlseldiv) as $row) {
    array_push($div_ID, $row['div_ID']);
}





$compName = $_POST['compName'];
$userID = 1; //aus Session Variable nehmen
$compDate = $_POST['compDate'];

$regCode = $_POST['regCode'];
$compID = 22;


$sql = "UPDATE `champscore_net`.`tbl_competition` SET `comp_name` = ? , `comp_date` = ? , `comp_regcode` = ? WHERE `comp_ID`= ?";

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$q = $pdo->prepare($sql);
$q->execute(array($compName, $compDate, $regCode, $compID));








$numbDiv = $_POST['selectDiv'];
$nameDiv;



for ($i = 1; $i <= $numbDiv; $i++) {
    $nameDiv = $_POST['nameDiv_' . $i];


    $sql = "UPDATE `champscore_net`.`tbl_division` SET `div_name` = ?  WHERE `div_ID`= ?";

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $q = $pdo->prepare($sql);
    $q->execute(array($nameDiv, $div_ID[$i-1]));



//INSERT EVENTS IN DB
     $anzevt = array();
        

        $sqlselanzevt = "SELECT * , count(fk_div_ID) as anzevt FROM `tbl_event` as a\n"
                . " INNER JOIN `tbl_division` as b\n"
                . " on a.fk_div_ID=b.div_ID\n"
                . " INNER JOIN `tbl_competition` as c\n"
                . " on b.fk_comp_ID=c.comp_ID\n"
                . " group by div_ID";

        foreach ($pdo->query($sqlselanzevt) as $row) {
            array_push($anzevt, $row['anzevt']);
        }
   
    
    
    $numbEvent=$_POST['selEvent'.$i];

    for ($a = 1; $a <= $numbEvent; $a++) {

 $sqlsel   =  "SELECT * , count(fk_div_ID) as anzevt FROM `tbl_event` as a\n"
     . " INNER JOIN `tbl_division` as b\n"
     . " on a.fk_div_ID=b.div_ID\n"
     . " INNER JOIN `tbl_competition` as c\n"
     . " on b.fk_comp_ID=c.comp_ID\n"
     . " \n"
     . "\n"
     . " group by evt_ID\n"
     . " order by div_ID,evt_ID";

       
        foreach ($pdo->query($sqlsel) as $row) {
             array_push($evt_ID, $row['evt_ID']);
        }

        $eventName = $_POST['event_' . $a . $i];

        $sql = "UPDATE `champscore_net`.`tbl_event` SET `evt_name` = ?  WHERE `evt_ID`= ?";

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $q = $pdo->prepare($sql);
        $q->execute(array($eventName, $evt_ID[$a-1]));


       

 
 $anzwod = array();
        

        $sqlselanzwod = "SELECT * , count(fk_evt_ID) as anzwod FROM `tbl_wod` as a\n"
                . " INNER JOIN `tbl_event` as d\n"
                . " on a.fk_evt_ID=d.evt_ID\n"
                . " INNER JOIN `tbl_division` as b\n"
                . " on d.fk_div_ID=b.div_ID\n"
                . " INNER JOIN `tbl_competition` as c\n"
                . " on b.fk_comp_ID=c.comp_ID \n"
                . " group by evt_ID\n"
                . " order by div_ID,evt_ID, wod_ID";

        foreach ($pdo->query($sqlselanzwod) as $row) {
            array_push($anzwod, $row['anzwod']);
        }
        echo var_dump($anzwod);
 
  $numbWod=$_POST['selWod'.$a.$i];
 
        for ($c = 1; $c <= $numbWod; $c++) {
 $wodName=$_POST['inputWod'.$a.$i.$c];
        $wodDesc=$_POST['textWod'.$a.$i.$c];
            
             $sqlselwod = "SELECT * , count(fk_evt_ID) as anzwod FROM `tbl_wod` as a\n"
     . " INNER JOIN `tbl_event` as d\n"
     . " on a.fk_evt_ID=d.evt_ID\n"
     . " INNER JOIN `tbl_division` as b\n"
     . " on d.fk_div_ID=b.div_ID\n"
     . " INNER JOIN `tbl_competition` as c\n"
     . " on b.fk_comp_ID=c.comp_ID \n"
     . " group by wod_ID\n"
     . " order by div_ID,evt_ID, wod_ID";

           
            foreach ($pdo->query($sqlselwod) as $row) {
               array_push($wod_ID, $row['wod_ID']);


              
            }
            $sql = "UPDATE `champscore_net`.`tbl_wod` SET `wod_name` = ? , `wod_desc` = ?  WHERE `wod_ID`= ?";

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $q = $pdo->prepare($sql);
                $q->execute(array($wodName, $wodDesc, $wod_ID[$c-1]));
                array_splice($anzevt,0,$numbDiv);
        }
          
    }
    array_splice($evt_ID,0,$numbEvent);
    array_splice($wod_ID,0,$numbWod);
    //array_splice($anzwod,0,$numbEvent);
  
    
}









Database::disconnect();
?>
   