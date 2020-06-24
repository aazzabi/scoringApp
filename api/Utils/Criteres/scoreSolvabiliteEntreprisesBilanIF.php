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

//On récupére la créance by ID ( passé en paramétre )
$creance = $creanCtrl->getById($id);

//On récupére le contribuable by $creance->id
$contribuable = $contribCtrl->getById($creance['idCtr']);

$mnt  = $contribuable['montantExcedentBrutExploitation'];
$dette  = $contribuable['montantDetteFiscale'];

if (($mnt <= 0 ) || ($mnt == null)){
    echo 0;
} else if ($mnt <= ($dette/4) ) {// 0---> 25%
    echo 1;
} else if (($mnt > ($dette/4)) && ($mnt <= ($dette/2) )) { // 25--->50%
    echo 2;
} else if ($mnt == $dette){
    echo 4;
} else {
    echo 3;
}

/*Viabilité (entreprises) par le bilan
Si Excédent brut d'exploitation  <= à 0 score = 0
Sinon si  Excédent brut d'exploitation==25%*dette fiscale score = 1
Sinon si  Excédent brut d'exploitation==50%*dette fiscale score = 2
Sinon Excédent brut d'exploitation== dette fiscale score = 3 */
