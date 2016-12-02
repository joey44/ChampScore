
<?php
echo "<H1>Folgende Eintr&auml;ge enth&auml;lt die Tabelle \"adressen\"</H1><br/>\n";
require ("configuration.php");

$link = mysqli_connect("localhost", $benutzer, $passwort);
mysqli_select_db($link, $dbname);
$abfrage = "select * from REGDATA";
$ergebnis = mysqli_query($link, $abfrage) or die(mysqli_error());
echo "<table border=\"1\">";

while ($zeile = mysqli_fetch_array($ergebnis, MYSQLI_ASSOC))
	{
	echo "<tr>";
	while (list($schluessel, $wert) = each($zeile))
		{
		echo "<td>" . $wert . "</td>";
		}

	echo "</tr>";
	}

echo "</table>";
mysqli_close($link);
?>