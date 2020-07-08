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


$mnt  = $contribuable['montantDesImpositionDeclareesSpontanement'];

 if ($mnt <= 50 ) {
    echo 0;
} else if (($mnt > 50) && ($mnt<= 75 )) {
    echo 1 * $critere['coefficient'];
} else if (($mnt > 75) && ($mnt<=90)) {
    echo 2 * $critere['coefficient'];
} else if ($mnt > 90){
    echo 3 * $critere['coefficient'];
}
/* Si  impositions déclarées spontanément < 50% score 0
Sinon si 50% < Pourcentage des impositions déclarées spontanément < 75% score = 1
Sinon si 75% < Pourcentage des impositions déclarées spontanément< 90% score = 2
Sinon (Pourcentage des impositions déclarées spontanément > 90%)  score = 3 */
