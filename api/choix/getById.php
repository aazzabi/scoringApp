<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Choix.php ';

$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];
$cx = new Choix($pdo);

echo json_encode($cx->getById($id),true);
?>
