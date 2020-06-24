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

$montant = $contribuable['montantDetteFiscale'];

$montantDette1 = $contribuable['montantDette1'];
$montantDette2 = $contribuable['montantDette2'];
$montantDette3 = $contribuable['montantDette3'];
$montantDette4 = $contribuable['montantDette4'];
$totalDettes = $montantDette1 + $montantDette2 + $montantDette3 + $montantDette4 ;

if ($montant <= ($totalDettes*0.25)) {
    echo 0;
} else if ((($totalDettes*0.25) < $montant) && ($montant <= ($totalDettes*0.5)) ) {
    echo 1;
} else if ((($totalDettes*0.5) < $montant) && ($montant <= ($totalDettes*0.75))) {
    echo 2;
} else if (($totalDettes*0.75) > $montant) {
    echo 3;
}

/* si Dette fiscale  moins de 25 % * total des dettes score=0
sinon si Dette fiscale  entre 25 % et 50 % * total des dettes score=1
sinon si Dette fiscale  entre 50 % et 75 % * total des dettes score=2
sinon (Dette fiscale  > 75 % * total des dettes) score=3
*/ 