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

$val  = $contribuable['valeurDuPatrimoine'];
$dette  = $contribuable['montantDetteFiscale'];

if (($val ==0 ) || ($val == null)){
    echo 0;
} else if ($val == ($dette/4) ) {
    echo 1;
} else if ($val == ($dette/2) ) {
    echo 2;
} else if ($val == $dette){
    echo 3;
}
/* Solvabilité par le patrimoine
Si Aucun patrimoine connu score=0
Sinon si patrimoine == 25%*dette fiscale  score=1
Sinon si patrimoine== 50%* dette fiscale score=2
Sinon patrimoine==dette fiscale score=3 */
