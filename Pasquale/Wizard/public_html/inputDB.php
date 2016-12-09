
        <?php
        include 'Database.php';
        $pdo= Database::connect();
        
        var_dump($_POST);
        
        $compName=$_POST['compName'];
        $userID=1; //aus Session Variable nehmen
        $compDate=2001-00-00;

        $regCode=$_POST['compregCode'];
        
        
        $sql = "INSERT INTO `tbl_competition` ( `comp_name`, `comp_regcode`, `comp_date`, `fk_user_ID`) VALUES (?,?,?,?)";
        
        
        
          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	 $q = $pdo->prepare($sql);
	 $q->execute(array($compName,$regCode,$compDate,$userID)); 
        
        
        
        
        Database::disconnect();
        ?>
   