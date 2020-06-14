<?php
header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$req = "SELECT * FROM contribuable";
$res = $pdo->query($req);
$m = '[';
foreach ($res as $row) {
    $m = $m .
    '{
        "id":"' . $row['id'] . '"
        ,"libelle":"' . $row['libelle'] . '"
        ,"formeJuridique":"' . $row['formeJuridique'] . '"
        ,"activite":"' . $row['activite'] . '"},';
  }
$m = substr($m, 0, strlen($m) - 1);
$m = $m . ']';
echo $m;







//header("Access-Control-Allow-Origin: *");
//header('Content-type: application/json');
//
//require_once('../connect.php ');
//require_once  '../Models/Contribuable.php';
//
//$cnx = new connexion();
//$pdo = $cnx->CNXbase();
//
//$contribuable = new Contribuable($pdo);
//echo json_encode($contribuable->getAll(), true);
//?>
