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
  <h2>Rangliste WOD 1</h2>
  <p>WOD Beschreibung.........</p>            
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
include 'Database.php';
$pdo = Database::connect();
$sql = "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID ORDER BY Punkte ASC";
	

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

<form  action="rangliste_pdf.php">  

<button id="btn_pdf" name="btn_pdf" class="btn btn-primary">PDF Export</button>

</form > 

</div>

</body>
</html>
