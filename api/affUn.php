<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");

require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];
$req = "SELECT * FROM entreprises where id='$id'";
$res = $pdo->query($req);
$row = $res->fetch();

echo '{"_id":"' . $row[0] . '","nom":"' . $row[1] . '","activite":"' . $row[2] . '","formejur":"' . $row[3] . '","score":"' . $row[4] . '"}';
?>
