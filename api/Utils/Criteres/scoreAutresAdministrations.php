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
$mntDouane = $contribuable['montantDroitsDouaneDeclaresSpontanement'];
$mntSocial = $contribuable['montantTotalCotisationsSociales'];


if ($mntDouane < 50) {
    echo 0;
}
else if ($mntSocial < 50 ) {
    echo 0;
}

/*
si Montant des droits de douane déclarés spontanément<50 % score=0
sinon si Montant total des cotisations sociale<50 % score=0
*/