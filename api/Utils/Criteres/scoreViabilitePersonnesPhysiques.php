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

$montantRevenuGlobalDeclare1  = $contribuable['montantRevenuGlobalDeclare1'];
$montantRevenuGlobalDeclare2  = $contribuable['montantRevenuGlobalDeclare2'];
$montantRevenuGlobalDeclare3  = $contribuable['montantRevenuGlobalDeclare3'];
$totalRevenu = $montantRevenuGlobalDeclare3 + $montantRevenuGlobalDeclare2 + $montantRevenuGlobalDeclare1;
$moyeRevenu = ($totalRevenu)/3;

$dette  = $contribuable['montantDetteFiscale'];

if ($moyeRevenu < $dette) {
    echo 0;
} else if ($moyeRevenu > ($dette*12)) {
    echo 3;
} else if ($moyeRevenu > ($dette*3 )) {
    echo 2;
} else if ($moyeRevenu > $dette) {
    echo 1;
}
// glebt l ordre mta3hom 5ater sinon bech yhez l test lowel (moy> dette)=> echo 1

/*Moyenne du revenu global= ( revenu global déclaré n-3 + revenu global déclaré n-2 + revenu global déclaré n-1 ) / 3
si Moyenne du revenu global < dette fiscale score= 0 
sinon si Moyenne du revenu global > dette fiscale score= 1
sinon si Moyenne du revenu global > dette fiscale  * 3 score= 2
sinon si Moyenne du revenu global > dette fiscale  * 12 score= 3
sinon si */ 
