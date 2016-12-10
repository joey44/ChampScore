<?PHP

session_start();

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



$abfrage = "update tbl_user_address
        SET user_addr_firstname =$firstName, user_addr_lastname=$lastName, user_addr_street=$street, user_addr_zip=$zip,
            user_addr_state=$state, user_addr_country=$country where fk_user_id=" . $_SESSION["user_id"];
$ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
$count = mysqli_num_rows($ergebnis);


mysqli_close($link);
?>
