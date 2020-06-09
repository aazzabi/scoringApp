<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$req = "SELECT c.id, c.libelle , c.isActive , cre.recette
        FROM `critere`as c, `creance`as cre
        WHERE c.creance_id = cre.id";
$res = $pdo->query($req);
$m = '[';
foreach ($res as $row) {
    $m = $m . '{"id":"' . $row[0] . '"
    ,"libelle":"' . $row[1] . '"
    ,"isActive":"' . $row[2] . '"
    ,"recette":"' . $row[3] .'"},';
}
$m = substr($m, 0, strlen($m) - 1);
$m = $m . ']';
echo $m;


?>
