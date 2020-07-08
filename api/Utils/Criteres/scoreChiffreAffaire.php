<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd().'../../Models/Creance.php';
require_once getcwd().'../../Models/Contribuable.php';
require_once getcwd().'../../Models/Critere.php';
require_once getcwd().'../../connect.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$creanCtrl = new Creance($pdo);
$contribCtrl = new Contribuable($pdo);

$id = $_GET['id'];
$creance = $creanCtrl->getById($id);
$contribuable = $contribCtrl->getById($creance['idCtr']);

$critereCtrl = new Critere($pdo);
$idCritere = $_GET['idCritere'];
$critere = $critereCtrl->getById($idCritere);

$caht = $contribuable['CahtAnnuel'];

if ($caht <= 100000) {
    echo 0;
} else if ((100000 < $caht) && ($caht <= 2000000) ) {
    echo 1 * $critere['coefficient'];
} else if ((2000000 < $caht) && ($caht <= 200000000)) {
    echo 2 * $critere['coefficient'];
} else if (200000000 < $caht) {
    echo 3 * $critere['coefficient'];
}


/* 
si CAHT annuel   < 100 000 M score= 0
sinon si CAHT annuel  compris entre 100 000 DT et 2M DT score=1 
sinon si CAHT annuel compris entre 2 M DT et 200 M DT score=2 
sinon (CAHT annuel > 200 M DT) score=3 
*/