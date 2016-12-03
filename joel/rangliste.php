<!DOCTYPE html>
<html lang="en">
<head>
  <title>Rangliste WOD 1</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
  <h2>Rangliste </h2>
  <form class="form-horizontal" action="rangliste.php" method="post"> 
   <table class="table table-hover">
      <tr>
         <?php
        $wod_array = array();
        $wod_count = 1;
        $divison = 1;
        include 'Database.php';
        $pdo = Database::connect();
        $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $divison";
        foreach ($pdo->query($sql) as $row) {
        echo 
            
           "<th><button type='submit' value='".$row['wod_ID']."' id='".$row['wod_ID']."' name='wod_button' class='btn btn-primary'>".$row['evt_name']." <br/> ".$row['wod_name']." </button>  </th> ";
      
        
        $wod_array[$wod_count] = $row['wod_ID'];
        
        $wod_count++;
  

	  
	}
        
        ?>
        
      </tr>
   </table>
  </form>
<?php

 

        if (isset($_POST['wod_button']))
             {
             $selected_wod = $_POST['wod_button'];
        
       

      $sql=  "SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =".$selected_wod;
        
      foreach ($pdo->query($sql) as $row) {
        echo "<p>". $row['Description']."</p>";
      }
        
  ?>
          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Box</th>
        <th>Punkte</th>
      </tr>
    </thead>
	<tbody>

	
<?php



$sql = "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID where r.fk_wod_ID =".$selected_wod." ORDER BY Punkte ASC";
	

foreach ($pdo->query($sql) as $row) {
   echo "
      <tr>
        <td>".$row['Name']."</td>
        <td> ".$row['Box']." </td>
        <td> ".$row['Punkte']." </td>
      </tr>";
  

	  
	}

Database::disconnect();
?>

    </tbody>
  </table>

  <form  action="rangliste_pdf.php" method="post">  

      <button type="submit" value="<?php echo $selected_wod ?>" id="btn_pdf" name="btn_pdf" class="btn btn-primary">PDF Export</button>

</form > 

<?php

}
?>
</div>

   
</body>
</html>
