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
$critereCtrl = new Critere($pdo);

//id creance
$id = $_GET['id'];
$idCritere = $_GET['idCritere'];

//On récupére la créance by ID ( passé en paramétre )
$creance = $creanCtrl->getById($id);

//On récupére le contribuable by $creance->id
$contribuable = $contribCtrl->getById($creance['idCtr']);
$critere = $critereCtrl->getById($idCritere);

// on fixe les date auquel on va appliquer le test de difference
$dateDebut = new DateTime($contribuable['dateDebutActivite']);
$now = new DateTime();

//difference (en année %y) entre date d'aujourdhui et la date début de creance
$diff = $dateDebut->diff($now)->format("%y");
// Test statiques des scores possible
if ($diff <= 2) {
    echo 0;
    //echo 1 * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $critéreAnciennete['coefficient']
    //echo $choix['pondere'] * $choix['coefficient']
} else if ((2 < $diff) and ($diff<= 5) ) {
    echo 1 * $critere['coefficient'];
} else if ((5 < $diff) and ($diff<= 20) ) {
    echo 2 * $critere['coefficient'];
}  else if (20 < $diff)  {
    echo 3 * $critere['coefficient'];
}
// si ($diff<=2) score=0 sinon si (2<$diff<=5) score= 1 sinon si (5<$diff<=20) score=2 sinon ($diff>20) score=3
