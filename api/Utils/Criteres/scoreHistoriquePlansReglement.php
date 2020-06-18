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
$nbr =  $contribuable['plansDeReglement'] ;

// Test statiques des scores possible
if ($nbr >= 1) {
    echo 0;
    //echo 1 * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $choix['coefficient']
} else if ($nbr == 0 ) {
    echo 1;
}

/*
 * Amnisitie ??
 * Autre plan ???
 */


/* Plan de règlement
si au moins 1 Plans de reglement score=0 
sinon si Plans de reglement=0  score=1 
sinon si amnistie >=1 score=2
sinon si autre plan >=1 score=3 
*/ 