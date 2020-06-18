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

// on fixe les date auquel on va appliquer le test de difference
$dateDebut = new DateTime($contribuable['dateActionRecouvrementOffensive']);
$now = new DateTime();

//difference (en année %y) entre date d'aujourdhui et la date début de creance
$diff = $dateDebut->diff($now)->format("%y");

// Test statiques des scores possible
if ($dateDebut == null) {
    echo 0;
    //echo 1 * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $choix['coefficient']
} else if (2 > $diff) {
    echo 1;
} else if (1 > $diff) {
    echo 2;
}  else if ($diff == 0)  {
    echo 3;
}
/* Historique de l’action en recouvrement
Si Aucune Date action en recouvrement offensive== null score =0
Sinon si Date action en recouvrement offensive <= n-2 score =1
Sinon si Date action en recouvrement offensive <= n-1 score =2
Sinon  Date action en recouvrement offensive = n(dateSys) score=3 */
