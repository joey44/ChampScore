<?PHP

session_start();


$comp_ID = $_POST['comp_ID'];

require ("./public_html/php/loginsec/db.inc.php");
/* check user already registered */

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);
$abfrage = "DELETE FROM tbl_competition WHERE comp_ID = ".$comp_ID;
$ergebnis = mysqli_query($link, $abfrage) or die(mysql_error());


mysqli_close($link);
?>
