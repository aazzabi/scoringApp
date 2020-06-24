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

$decla = $contribuable['declarationDeposees'];

if ($decla <= 50) {
    echo 0;
} else if ((50 < $decla) && ($decla <= 75) ) {
    echo 2;
} else if ((75 < $decla) && ($decla <= 90)) {
    echo 3;
} else if (90 < $decla) {
    echo 4;
}
/* si declarations deposees <50% score=0
*sinon si 50%<declarations deposees <75% score=2
*sinon si 75%<declarations deposees <90% score=3
*sinon (>90%) score=4   */