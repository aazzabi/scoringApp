<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];
$req = "SELECT c.id, c.libelle , c.isActive , cre.recette
               FROM `critere`as c, `creance`as cre
               WHERE c.id = $id and c.creance_id = cre.id";
$res = $pdo->query($req);
$row = $res->fetch();

echo '{"id":"' . $row[0] . '" ,"libelle":"' . $row[1] . '" ,"isActive":"' . $row[2] .'"},';
?>
