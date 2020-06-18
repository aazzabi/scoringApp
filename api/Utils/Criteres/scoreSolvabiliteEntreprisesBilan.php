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

$valImmob  = $contribuable['valeurImmobilisationsCorporellesEtIncorporelles'];
$dette  = $contribuable['montantDetteFiscale'];

if (($valImmob ==0 ) || ($valImmob == null)){
    echo 0;
} else if ($valImmob == ($dette/4) ) {
    echo 1;
} else if ($valImmob == ($dette/2) ) {
    echo 2;
} else if ($valImmob == $dette){
    echo 3;
}

/*Solvabilité (entreprises) par le bilan, immobilisations corporelles et incorporelles
Si immobilisations corporelles ou incorporelles 9 (pas dispo) score =0
Sinon si immobilisations corporelles et incorporelles ==25%*dette fiscale score =1
Sinon si immobilisations corporelles et incorporelles ==50%*dette fiscale score =2
Sinon immobilisations corporelles et incorporelles ==dette fiscale  score =3 */
