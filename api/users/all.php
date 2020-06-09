<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$req = "SELECT * FROM user";
$res = $pdo->query($req);
$m = '[';
foreach ($res as $row) {
    $m = $m . '{"id":"' . $row['id'] . '"
    ,"nom":"' . $row['nom'] . '"
    ,"prenom":"' . $row['prenom'] . '"
    ,"email":"' . $row['email'] . '"
    ,"username":"' . $row['username'] . '"
    ,"role":"' . $row['role']
    . '"},';
}
$m = substr($m, 0, strlen($m) - 1);
$m = $m . ']';
echo $m;


?>
