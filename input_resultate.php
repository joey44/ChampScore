<?php 
	
	require 'Database.php';
	
	
	if ( !empty($_POST)) {
		// keep track validation errors
		$wod_punkteError = null;
		$athlet_nameError = null;
		
		
		// keep track post values
		$wod_punkte = $_POST['wod_punkte'];
		$athlet_name = $_POST['athlet_name'];
		$wodselectbasic = $_POST['wodselectbasic'];
		
		// validate input
		$valid = true;
		if (empty($wod_punkte)) {
			$wod_punkteError = 'Please enter wod_punkte';
			$valid = false;
		}
		
		
		if (empty($athlet_name)) {
			$athlet_nameError = 'Please enter athlet_name';
			$valid = false;
		}
		
		// insert data
		if ($valid) {
			$pdo = Database::connect();
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "INSERT INTO tbl_result (fk_user_div_ID, fk_wod_ID, res_score) values(?, ?, ?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($athlet_name,$wodselectbasic,$wod_punkte));
			Database::disconnect();
			header("Location: rangliste.php");
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Resulate eingeben</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
  

<form class="form-horizontal" action="input_resultate.php" method="post">
<fieldset>

<!-- Form Name -->
<legend>Resulate eingeben</legend>

<!-- Select Competition -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Competition</label>
  <div class="col-md-4">
    <select id="selectbasic" name="wodselectbasic" class="form-control">

<?php
$pdo = Database::connect();
$sql = "SELECT comp_name, comp_ID FROM `tbl_competition`";

?>

<?php
foreach ($pdo->query($sql) as $row):
?>
    <option value="<?= $row["comp_ID"] ?>"><?= $row["comp_name"] ?></option>
<?php
endforeach;
?>
<?php
//Database::disconnect();
?>

    </select>
  </div>
</div>


<!-- Select Division -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Division</label>
  <div class="col-md-4">
    <select id="selectbasic" name="divselectbasic" class="form-control">

<?php
//$pdo = Database::connect();
$sql = "SELECT div_name, div_ID FROM `tbl_division`";

?>

<?php
foreach ($pdo->query($sql) as $row):
?>
    <option value="<?= $row["div_ID"] ?>"><?= $row["div_name"] ?></option>
<?php
endforeach;
?>
<?php
//Database::disconnect();
?>

    </select>
  </div>
</div>



<!-- Select Event -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">Event</label>
  <div class="col-md-4">
    <select id="selectbasic" name="eventselectbasic" class="form-control">

<?php
//$pdo = Database::connect();
$sql = "SELECT evt_name, evt_ID FROM `tbl_event`";

?>

<?php
foreach ($pdo->query($sql) as $row):
?>
    <option value="<?= $row["evt_ID"] ?>"><?= $row["evt_name"] ?></option>
<?php
endforeach;
?>
<?php
//Database::disconnect();
?>

    </select>
  </div>
</div>


<!-- Select WOD -->
<div class="form-group">
  <label class="col-md-4 control-label" for="selectbasic">WOD</label>
  <div class="col-md-4">
    <select id="selectbasic" name="wodselectbasic" class="form-control">

<?php
//$pdo = Database::connect();
$sql = "SELECT wod_name, wod_ID FROM `tbl_wod`";

?>

<?php
foreach ($pdo->query($sql) as $row):
?>
    <option value="<?= $row["wod_ID"] ?>"><?= $row["wod_name"] ?></option>
<?php
endforeach;
?>
<?php
Database::disconnect();
?>

    </select>
  </div>
</div>






<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="athlet_name">Athlet Name</label>  
  <div class="col-md-4">
  <input id="athlet_name" name="athlet_name" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="Punkte">Punkte in WOD</label>  
  <div class="col-md-4">
  <input id="wod_punkte" name="wod_punkte" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="btn_save"></label>
  <div class="col-md-4">
    <button id="btn_save" name="btn_save" class="btn btn-primary" >speichern</button>
  </div>
</div>

</fieldset>
</form>


</body>
</html>
