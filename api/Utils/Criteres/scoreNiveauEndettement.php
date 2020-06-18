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
$totalActif = $contribuable['montantTotalActif'];
$capitauxP = $contribuable['montantCapitauxPropres'];

$val = (($totalActif - $capitauxP) / $totalActif);
if ($val > 75) {
    echo 0;
} else if (($val <= 75) && ($val > 50)) {
    echo 1;
} else if (($val <= 50) && ($val > 25)) {
    echo 2;
} else {
    echo 3;
}
/*Taux d'endettement = (Total de l'actif - capitaux propres)/total de l'actif
si Taux d'endettement > 75 %  score= 0 
sion si Taux d'endettement compris entre 50 % et 75 % score=1 
Taux d'endettement compris entre 25 % et 50 % score= 2 
sinon si Taux d'endettement Taux d'endettement < 25 % score= 3 */