<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

require_once('../connect.php ');
require_once  '../Models/Contribuable.php';

$cnx = new connexion();
$pdo = $cnx->CNXbase();

$contribuable = new Contribuable($pdo);
echo json_encode($contribuable->getAll(), true);
?>
