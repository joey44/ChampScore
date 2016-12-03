<!DOCTYPE html>
<html lang="en">
<head>
  <title>Input Resluts
  
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>


<div class="container">
  <h2>Input Results Divison <?php 
  
  $divison = $_POST['divselectbasic'];
  
  echo $divison;

  ?>
  
  </h2>
  <p>input or update the results</p> 
  
  <form  class="form-horizontal" action="#" method="post">  
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Box</th>    
        <?php
        $wod_array = array();
        $wod_count = 1;
        include 'Database.php';
        $pdo = Database::connect();
        $sql = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $divison";
        foreach ($pdo->query($sql) as $row) {
        echo 
         "<th> ".$row['evt_name']." </br> ".$row['wod_name']." </th> "   ;
        
        $wod_array[$wod_count] = $row['wod_ID'];
        
        $wod_count++;
  

	  
	}
        
        ?>
        
      </tr>
    </thead>
	<tbody>

	
<?php


$sql = "SELECT user_name as Name, user_box as Box FROM `tbl_user` join tbl_user_division on fk_user_ID =user_ID";

$fiel_count = 1;
foreach ($pdo->query($sql) as $row) {
   echo "
      <tr>
        <td>".$row['Name']."</td>
        <td> ".$row['Box']." </td>";
            for($count = 1; $count < $wod_count; $count++)
                {
                   echo "    <td> <input id='".$fiel_count."'name='score' type='text'  placeholder='score' "
                           . "value='0'> </td>";
               
                   $fiel_count++;
                 }

       
   echo "   </tr>";
  

	  
	}

Database::disconnect();
?>

    </tbody>
  </table>



<button id="save_pdf" name="btn_save" class="btn btn-primary">save</button>

</form > 

</div>
   <?php var_dump($wod_array);?>

</body>
</html>
