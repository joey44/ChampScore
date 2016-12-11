<?PHP

session_start();


$wod_ID = $_POST['wod_ID'];
$div_ID = $_POST['div_ID'];

require ("./public_html/php/loginsec/db.inc.php");
/* check user already registered */

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);

if ($wod_ID == "overall123") {

    $msg = "<p>Overall Ranking </p>";
    echo $msg;
} else {

    $abfrage = "SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =" . $wod_ID;
    $ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
    $count = mysqli_num_rows($ergebnis);

    if ($count >= 1) {


        while ($row = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
            $msg = "<p>" . $row['Description'] . "</p>";

            echo $msg;
        }
    }
}

$msg = "<table class = \"table table-hover\">
<thead>
<tr>
<th>Name</th>
<th>Box</th>
<th>Points</th>
</tr>
</thead>
<tbody>";

if ($wod_ID == "overall123") {


    $abfrage = "SELECT u.user_name as Name, u.user_box as Box, SUM(r.res_score) as Punkte FROM tbl_user u inner \n"
            . " join tbl_user_division d\n"
            . " on u.user_ID = d.fk_user_ID inner \n"
            . " join tbl_result r on d.user_div_ID = r.fk_user_div_ID \n"
            . " WHERE d.fk_div_ID = " . $div_ID . " GROUP by Name ORDER by Punkte ASC";

    $ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
    $count = mysqli_num_rows($ergebnis);

    if ($count >= 1) {


        while ($row = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
            $msg = "
      <tr>
        <td>" . $row['Name'] . "</td>
        <td> " . $row['Box'] . " </td>
        <td> " . $row['Punkte'] . " </td>
      </tr>";

            echo $msg;
        }
    }


    /* foreach ($pdo->query($sql) as $row) {
      echo "
      <tr>
      <td>" . $row['Name'] . "</td>
      <td> " . $row['Box'] . " </td>
      <td> " . $row['Punkte'] . " </td>
      </tr>";
      } */
} else {



    $abfrage = "SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
            . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID where r.fk_wod_ID =" . $wod_ID . " ORDER BY Punkte ASC";

    $ergebnis = mysqli_query($link, $abfrage) or die($msg = "Fehler");
    $count = mysqli_num_rows($ergebnis);

    if ($count >= 1) {

        while ($row = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC)) {
            $msg = "
      <tr>
        <td>" . $row['Name'] . "</td>
        <td> " . $row['Box'] . " </td>
        <td> " . $row['Punkte'] . " </td>
      </tr>";

            echo $msg;
        }
    }

    /* foreach ($pdo->query($sql) as $row) {
      echo "
      <tr>
      <td>" . $row['Name'] . "</td>
      <td> " . $row['Box'] . " </td>
      <td> " . $row['Punkte'] . " </td>
      </tr>";
      } */
}
$msg = "</tbody>
</table>";
echo $msg;

/* Database::disconnect();
  ?>
 */

mysqli_close($link);
?>
