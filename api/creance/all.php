<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once('../connect.php ');
require_once '../Models/Creance.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$cr = new Creance($pdo);
echo $cr->getAllCreance();

?>
