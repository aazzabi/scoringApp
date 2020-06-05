<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");

require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];

$req = "DELETE FROM entreprises WHERE id='$id'";
$res = $pdo->exec($req);
//http_response_code(204);
