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
$mntDouane = $contribuable['montantDroitsDouaneDeclaresSpontanement'];
$mntSocial = $contribuable['montantTotalCotisationsSociales'];


if (($mntDouane < 50) || ($mntSocial < 50 ) ){
    echo 0;
} else {
    echo 1;
}

/*
si Montant des droits de douane déclarés spontanément<50 % score=0
sinon si Montant total des cotisations sociale<50 % score=0
*/