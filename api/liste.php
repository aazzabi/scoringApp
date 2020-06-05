<?php
header("Access-Control-Allow-Origin: *");
require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$req = "SELECT * FROM entreprises order by score desc";
$res = $pdo->query($req);
$m = '[';
foreach ($res as $row) {
    $m = $m . '{"_id":"' . $row[0] . '","nom":"' . $row[1] . '","activite":"' . $row[2] . '","formejur":"' . $row[3] . '","score":"' . $row[4] . '"},';
}
$m = substr($m, 0, strlen($m) - 1);
$m = $m . ']';
echo $m;


?>
