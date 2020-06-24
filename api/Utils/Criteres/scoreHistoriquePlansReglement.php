<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd().'../../Models/Creance.php';
require_once getcwd().'../../Models/Contribuable.php';
require_once getcwd().'../../connect.php ';


$cnx = new connexion();
$pdo = $cnx->CNXbase();
$creanCtrl = new Creance($pdo);
$contribCtrl = new Contribuable($pdo);

$id = $_GET['id'];

$creance = $creanCtrl->getById($id);
$contribuable = $contribCtrl->getById($creance['idCtr']);

$nbr =  $contribuable['plansDeReglement'] ;

if ($nbr >= 1) {
    echo 0;
} else if ($nbr == 0 ) {
    echo 1;
}

/* Plan de règlement
si au moins 1 Plans de reglement score=0 
sinon si Plans de reglement=0  score=1 
sinon si amnistie >=1 score=2
sinon si autre plan >=1 score=3 
*/ 