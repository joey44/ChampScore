<?PHP

session_start();


$div_ID = $_POST['div_ID'];

require ("./public_html/php/loginsec/db.inc.php");
/* check user already registered */

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);

$abfrage = "SELECT evt_ID, wod_ID, wod_name, evt_name FROM `tbl_wod` join tbl_event on fk_evt_ID = evt_ID WHERE `fk_div_ID` = $div_ID";
$ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
$count = mysqli_num_rows($ergebnis);

if ($count >= 1) {

    while ($row = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
        $msg = "<button onclick='onSelectWod(" . $row['wod_ID'] . ',' . $div_ID . ") '  value='" . $div_ID . "X" . $row['wod_ID'] . "' id='" . $row['wod_ID'] . "' ' class='btn btn-primary btn-lg'>
         " . $row['evt_name'] . " <br/> " . $row['wod_name'] . " </button>  </th> ";

        echo $msg;
    }
}

mysqli_close($link);
?>
