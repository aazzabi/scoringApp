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

$montant = $contribuable['montantDetteFiscale'];

if ($montant <= 25) {
    echo 0;
} else if ((25 < $montant) && ($montant <= 55) ) {
    echo 2;
} else if ((50 < $montant) && ($montant <= 75)) {
    echo 3;
} else if (75 < $montant) {
    echo 4;
}

/* si Dette fiscale  moins de 25 % * total des dettes score=0
sinon si Dette fiscale  entre 25 % et 50 % * total des dettes score=1
sinon si Dette fiscale  entre 50 % et 75 % * total des dettes score=2
sinon (Dette fiscale  > 75 % * total des dettes) score=3
*/ 