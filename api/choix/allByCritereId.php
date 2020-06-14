<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Choix.php ';

$cnx = new connexion();
$pdo = $cnx->CNXbase();
$cx = new Choix($pdo);

$id = $_GET['id'];

echo $cx->getAllByCritere($id);

?>
