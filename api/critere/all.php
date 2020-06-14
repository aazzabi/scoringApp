<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Critere.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$critere = new Critere($pdo);
echo json_encode($critere->getAll(), true);

?>
