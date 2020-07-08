<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd().'../../Models/Creance.php';
require_once getcwd().'../../Models/Contribuable.php';
require_once getcwd().'../../Models/Critere.php';
require_once getcwd().'../../connect.php';
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


$montant = $contribuable['loyersDeclares1'];
$dette = $contribuable['montantDetteFiscale'];

if (($montant == 0 ) || ($montant == null)){
    echo 0;
} else if ($montant <= ($montant/4) ) {// 0---> 25%
    echo 1 * $critere['coefficient'];
} else if (($montant > ($dette/4)) && ($montant <= ($dette/2) )) { // 25--->50%
    echo 2 * $critere['coefficient'];
} else if ($montant == $dette){
    echo 4 * $critere['coefficient'];
} else {
    echo 3 * $critere['coefficient'];
}

/* Existence de locataires
Si Absence de loyers déclarés score=0
Sinon si Loyers déclarés n-1==25%*dette fiscale score=1
Sinon si Loyers déclarés  n-1==50%*dette fiscale score=2
Sinon  Loyers déclarés n-1==dette fiscale score=3 */
