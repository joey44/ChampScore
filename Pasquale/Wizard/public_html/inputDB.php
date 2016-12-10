
        <?php
        include 'Database.php';
        $pdo= Database::connect();
        
        var_dump($_POST);
        
        
        // INSERT COMPETITION IN DB
        $compName=$_POST['compName'];
        $userID=1; //aus Session Variable nehmen
        $compDate=$_POST['compDate'];

        $regCode=$_POST['compregCode'];
        
        
        $sql = "INSERT INTO `tbl_competition` ( `comp_name`, `comp_regcode`, `comp_date`, `fk_user_ID`) VALUES (?,?,?,?)";
        
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($compName,$regCode,$compDate,$userID)); 
        
         
        
         
         
        //INSERT DIVISION IN DB
        $sqlsel = "SELECT `comp_id` FROM `tbl_competition` order by comp_id DESC Limit 1";
        
        $compID;
        foreach ($pdo->query($sqlsel) as $row) {
        $compID=$row['comp_id'];
        }
        
        $numbDiv=$_POST['selectDiv'];
        $nameDiv;
        
        
        
         for ($i = 1; $i <= $numbDiv; $i++) {
         $nameDiv=$_POST['nameDiv_'.$i];
         
         
        $sql = "INSERT INTO `tbl_division` (`div_name`, `fk_comp_ID`) VALUES (?, ?)";
        
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($nameDiv,$compID)); 
         
         
         
         //INSERT EVENTS IN DB
         $numbEvent=$_POST['selEvent'.$i];
         
          for ($a = 1; $a <= $numbEvent; $a++) {
          
          $sqlsel = "SELECT `div_ID` FROM `tbl_division` order by div_ID DESC Limit 1";
        
        $divID;
        foreach ($pdo->query($sqlsel) as $row) {
        $divID=$row['div_ID'];
        }
         
        $eventName=$_POST['event_'.$a.$i];
        
        $sql = "INSERT INTO `tbl_event` (`evt_name`, `fk_div_ID`) VALUES (?, ?)";
        
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($eventName,$divID));
         
         
         
         $numbWod=$_POST['selWod'.$a.$i];
          for ($c = 1; $c <= $numbWod; $c++) {
              
            $sqlsel = "SELECT `evt_ID` FROM `tbl_event` order by evt_ID DESC Limit 1";
        
        $evtID;
        foreach ($pdo->query($sqlsel) as $row) {
        $evtID=$row['evt_ID'];
        $wodName=$_POST['inputWod'.$a.$i.$c];
        $wodDesc=$_POST['textWod'.$a.$i.$c];
        
        
         $sql = "INSERT INTO `tbl_wod` (`wod_name`,`wod_desc`,`fk_evt_ID`) VALUES (?, ?,?)";
        
         $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($wodName,$wodDesc,$evtID));
        
        
        }   
              
              
              
              
          }
         
         
         
         
              
          }
         
         
         
         
         }
        
        
        
        
        
        
        
        
        
        Database::disconnect();
        ?>
   