<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require '../../Models/Creance.php';
require '../../Models/Contribuable.php';
require '../../connect.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$creanCtrl = new Creance($pdo);
$contribCtrl = new Contribuable($pdo);

$id = $_GET['id'];
$creance = $creanCtrl->getById($id);
$contribuable = $contribCtrl->getById($creance['idCtr']);

$montantDette1 = $contribuable['montantDette1'];
$montantDette2 = $contribuable['montantDette2'];
$montantDette3 = $contribuable['montantDette3'];
$montantDette4 = $contribuable['montantDette4'];


if (($montantDette4 < $montantDette3 ) && ($montantDette3 < $montantDette2) && ($montantDette2 < $montantDette1) ) {
    echo 0;
} else {
    echo 1;
}

/*
si Montant dette n-4 < Montant dette n-3  < Montant dette n-2 < Montant dette n-1 score=0
sinon score= 1
*/