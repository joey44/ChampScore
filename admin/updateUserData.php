<?PHP

session_start();

$userName = $_POST['username'];
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$street = $_POST['street'];
$zip = $_POST['zip'];
$state = $_POST['state'];
$country = $_POST['country'];
$birthdate = $_POST['birthdate'];
$gender = $_POST['gender'];




require ("./public_html/php/loginsec/db.inc.php");
/* check user already registered */

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);

$abfrage = "UPDATE\n"
        . " tbl_user_address\n"
        . "SET\n"
        . " user_addr_firstname ='$firstName',\n"
        . " user_addr_lastname ='$lastName',\n"
        . " user_addr_street ='$street',\n"
        . " user_addr_zip = '$zip',\n"
        . " user_addr_state = '$state',\n"
        . " user_addr_country = '$country'\n"
        . "WHERE\n"
        . " fk_user_id =" . $_SESSION["user_id"];

$ergebnis = mysqli_query($link, $abfrage) or die($msg = $abfrage);

mysqli_error($link);

$abfrage = "UPDATE\n"
        . " tbl_user\n"
        . "SET\n"
        . " user_name ='$userName',\n"
        . " user_gender ='$gender',\n"
        . " user_birthdate ='$birthdate'\n"
        . "WHERE\n"
        . " user_ID =" . $_SESSION["user_id"];

$ergebnis = mysqli_query($link, $abfrage) or die($msg = $abfrage);

mysqli_error($link);


mysqli_close($link);
$_SESSION['username'] = $userName;
?>
