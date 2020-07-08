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


// on fixe les date auquel on va appliquer le test de difference
$dateActionRecouvrementOffensive = new DateTime($contribuable['dateActionRecouvrementOffensive']);
$now = new DateTime();

//difference (en année %y) entre date d'aujourdhui et la date début de creance
$diff = $dateActionRecouvrementOffensive->diff($now)->format("%y");

// Test statiques des scores possible
if ($contribuable['dateActionRecouvrementOffensive'] == null) {
    echo 0;
} else if (2 <= $diff) {
    echo 1 * $critere['coefficient'];
} else if ((2 > $diff) && ($diff > 1)) {
    echo 2 * $critere['coefficient'];
}  else if ($diff < 1)  {
    echo 3 * $critere['coefficient'];
}
/* Historique de l’action en recouvrement
Si Aucune Date action en recouvrement offensive== null score =0
Sinon si Date action en recouvrement offensive <= n-2 score =1
Sinon si Date action en recouvrement offensive <= n-1 score =2
Sinon  Date action en recouvrement offensive = n(dateSys) score=3 */
