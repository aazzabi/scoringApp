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

//On récupére la créance by ID ( passé en paramétre )
$creance = $creanCtrl->getById($id);

//On récupére le contribuable by $creance->id
$contribuable = $contribCtrl->getById($creance['idCtr']);

$mnt  = $contribuable['montantTresorerie'];
$dette  = $contribuable['montantDetteFiscale'];

if ($mnt < 0 ) {
    echo 0;
} else if ($mnt == ($dette/4) ) {
    echo 1;
} else if ($mnt == ($dette/2) ) {
    echo 2;
} else if ($mnt == $dette){
    echo 3;
}

/*Situation de trésorerie 
Si Trésorerie < 0 score = 0
Sinon si  Trésorerie== 25%*dette fiscale score = 1
Sinon si Trésorerie== 50%*dette fiscale score= 2
Sinon Trésorerie== dette fiscale score=3 */
