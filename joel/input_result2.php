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
  $compID = 1; //Session ID
  
  echo $divison;

  ?>
  
  </h2>
  <p>input or update the results</p> 
  
  <form  class="form-horizontal" action="update_result.php" method="post">  
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
         "<th> ".$row['evt_name']." <br/> ".$row['wod_name']." </th> "   ;
        
        $wod_array[$wod_count] = $row['wod_ID'];
        
        $wod_count++;
  

	  
	}
        
        ?>
        
      </tr>
    </thead>
	<tbody>

	
<?php


//$sql = "select u.user_name as Name, u.user_box as Box,\n"
//    . "sum(if(fk_wod_ID=1,res_score,0)) as wod1,\n"
//    . "sum(if(fk_wod_ID=2,res_score,0)) as wod2,\n"
//    . "sum(if(fk_wod_ID=3,res_score,0)) as wod3,\n"
//    . "sum(if(fk_wod_ID=4,res_score,0)) as wod4,\n"
//    . "sum(if(fk_wod_ID=5,res_score,0)) as wod5\n"
//    . "from tbl_result r join tbl_user_division d \n"
//    . "on r.fk_user_div_ID = d.user_div_ID \n"
//    . "join tbl_user u on d.fk_user_ID = u.user_ID\n"
//    . "group by r.fk_user_div_ID";

$subsql = "";
 for($count1 = 1; $count1 < $wod_count; $count1++)
         {
            $subsql = $subsql.  ",\n sum(if(fk_wod_ID=".$wod_array[$count1].",res_score,0)) as wod"
                    . $count1
                    .", sum(if(r.fk_wod_ID=".$wod_array[$count1].",r.res_ID,0)) as resID"
                    .$count1;
         }

        
        $sql = "select d.user_div_ID, u.user_name as Name, u.user_box as Box"
                .$subsql
                ." from tbl_result r join tbl_user_division d on r.fk_user_div_ID = d.user_div_ID join tbl_user u "
                ."on d.fk_user_ID = u.user_ID where d.fk_div_ID ="
                .$divison." group by Name";




foreach ($pdo->query($sql) as $row) {
   echo "
      <tr>
        <td>".$row['Name']."</td>
        <td> ".$row['Box']." </td>";
            for($count = 1; $count < $wod_count; $count++)
                {
                   $wodas = "wod".$count;
                   $fieldID = $row["resID".$count]."X".$row["user_div_ID"]."X".$wod_array[$count] ;
                   
                   
                   echo "    <td> <input id='".$fieldID."' name='".$fieldID."' type='text'  placeholder='score' "
                           . "value='".$row[$wodas]."'> </td>";
               
                   
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
  
  

</body>
</html>
