<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd().'../../Models/Creance.php';
require_once getcwd().'../../Models/Contribuable.php';
require_once getcwd().'../../Models/Critere.php';
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

$critereCtrl = new Critere($pdo);
$idCritere = $_GET['idCritere'];
$critere = $critereCtrl->getById($idCritere);


$mnt  = $contribuable['valeurDuPatrimoine'];
$dette  = $contribuable['montantDetteFiscale'];


if (($mnt == 0 ) || ($mnt == null)){
    echo 0;
} else if ($mnt <= ($dette/4) ) {// 0---> 25%
    echo 1 * $critere['coefficient'];
} else if (($mnt > ($dette/4)) && ($mnt <= ($dette/2) )) { // 25--->50%
    echo 2 * $critere['coefficient'];
} else if ($mnt == $dette){
    echo 4 * $critere['coefficient'];
} else {
    echo 3 * $critere['coefficient'];
}
/* Solvabilité par le patrimoine
Si Aucun patrimoine connu score=0
Sinon si patrimoine == 25%*dette fiscale  score=1
Sinon si patrimoine== 50%* dette fiscale score=2
Sinon patrimoine==dette fiscale score=3 */
