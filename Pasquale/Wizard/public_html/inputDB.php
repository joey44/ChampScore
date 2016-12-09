
        <?php
        include 'Database.php';
        $pdo= Database::connect();
        
        var_dump($_POST);
        
        $compName=$_POST['fickdichphp'];
        $userID=1; //aus Session Variable nehmen
        
        $sql = "INSERT INTO `tbl_competition` ( `comp_name`, `comp_regcode`, `comp_date`, `fk_user_ID`) VALUES (?,?,?,?)";
        
        
        
        
        
        
        
        
        Database::disconnect();
        ?>
   