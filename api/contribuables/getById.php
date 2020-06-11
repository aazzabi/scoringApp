<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');

require_once('../connect.php ');
require_once  '../Models/Contribuable.php';

$cnx = new connexion();
$pdo = $cnx->CNXbase();
$contribuable = new Contribuable($pdo);

$id = $_GET['id'];
echo json_encode($contribuable->getById($id), true);
?>
