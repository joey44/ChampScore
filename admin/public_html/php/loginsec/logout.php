<?PHP

session_start();
session_destroy();
header("Location: ../../ChampScoreIndex.php");
    exit();

?>