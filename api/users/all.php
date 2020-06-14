<?php
header("Access-Control-Allow-Origin: *");
// headers to tell that result is JSON
header('Content-type: application/json');
require_once  '../Models/User.php';
require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$user = new User($pdo);

echo json_encode($user->getAll(), true);


?>
