<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Critere.php ';

$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];
$critere = new Critere($pdo);

echo json_encode($critere->getById($id),true);
?>
