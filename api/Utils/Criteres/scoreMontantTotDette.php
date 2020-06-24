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

$montantDette1 = $contribuable['montantDette1'];
$montantDette2 = $contribuable['montantDette2'];
$montantDette3 = $contribuable['montantDette3'];
$montantDette4 = $contribuable['montantDette4'];

$tot = $montantDette1 + $montantDette2 + $montantDette3 + $montantDette4;

if ($tot > 10000000000) {
    echo 0;
} else if ((1000000000 < $tot) && ($tot <= 10000000000) ) {//sinon si 1 M DT > dette > 10 M DT score= 1
    echo 1;
} else if ((100000 < $tot) && ($tot <= 1000000000) ) { //sinon si 100000 DT > dette > 1 M DT score= 2
    echo 2;
} else if ((10000 < $tot) && ($tot <= 100000) ) {//sinon si 10000 DT > dette > 100000 DT score= 3
    echo 3;
} else if ((1000 < $tot) && ($tot <= 10000) ) {//sinon si 1000 DT > Dette > 10 000 DT score= 4
    echo 4;
} else if ( $tot <= 1000  ) {//sinon (Dette < 1000 DT ) score= 5
    echo 5;
}

/* 
si dette > 10 M DT score= 0 
sinon si 1 M DT > dette > 10 M DT score= 1
sinon si 100 000 DT > dette > 1 M DT score= 2
sinon si 10 000 DT > dette > 100 000 DT score= 3
sinon si 1000 DT > Dette > 10 000 DT score= 4
sinon (Dette > 1000 DT ) score= 5 
*/ 
