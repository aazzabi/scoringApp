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

$cautionBancaire = $contribuable['cautionBancaire']; // string
$autresGaranties = $contribuable['autresGaranties']; // string
$garantiePrivSurImmeuble = $contribuable['garantiePrivilegeSurImmeuble']; // string

if (($autresGaranties == '' ) && ($garantiePrivSurImmeuble == '') && ($cautionBancaire == '')) {
    echo 0;
} else if ( ($garantiePrivSurImmeuble != '') ) {
    echo 2;
} else if ($cautionBancaire != '' ) {
    echo 3;
} else {
    echo 1;
}

/* Garanties
Si Aucune garantie (les 2 garanties)  == null score=0
Sinon si Garantie  !=null ou caution bancaire !=null score=1
Sinon si Existence d'un privilège sur immeuble score=2
Sinon Existence d'une caution bancaire score=3 */
