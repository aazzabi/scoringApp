<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
require_once  '../Models/Contribuable.php';

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];

$contribuable = new Contribuable($pdo);
echo $contribuable->delete($id);
