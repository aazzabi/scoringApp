<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');
include_once '../../Models/Creance.php';
include_once '../../Models/Contribuable.php';
require_once '../../connect.php ';

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
$dateDebut = new DateTime($creance['dateDebut']);
$now = new DateTime();

//difference (en année %y) entre date d'aujourdhui et la date début de creance
$diff = $dateDebut->diff($now)->format("%y");

// Test statiques des scores possible
if ($diff < 1) {
    echo 1;
    //echo 1 * $critéreAnciennete['coefficient']
    //echo $critéreAnciennete['pondere'] * $critéreAnciennete['coefficient']
} else {
    echo 2;
}
