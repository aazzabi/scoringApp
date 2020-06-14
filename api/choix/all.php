<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Choix.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$cx = new Choix($pdo);
echo json_encode($cx->getAll(), true);
//echo json_encode($critere->getById(2), true);

?>
