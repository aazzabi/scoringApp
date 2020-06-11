<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
include_once getcwd().'../../Models/User.php';
require_once getcwd().'../../connect.php ' ;

$cnx = new connexion();
$pdo = $cnx->CNXbase();


$id = $_GET['id'];

//$user = new User($pdo);
//$v = $user->getById($id);
//echo json_encode($v, true);

echo $id;

//echo 5;