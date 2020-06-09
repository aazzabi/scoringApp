<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');
require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];
$req = "SELECT * FROM user where id='$id'";

$res = $pdo->query($req);
$row = $res->fetch();

try{
  echo '{"id":"' . $row['id'] . '"
         ,"nom":"' . $row['nom'] . '"
         ,"prenom":"' . $row['prenom'] . '"
         ,"email":"' . $row['email'] . '"
         ,"username":"' . $row['username'] . '"
         ,"role":"' . $row['role']
         . '"},';
}catch(Exception $e) {
  echo $e;
}
?>
