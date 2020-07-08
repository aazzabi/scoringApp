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


$valImmo  = $contribuable['valeurImmobilisationsCorporellesEtIncorporelles'];

$dette  = $contribuable['montantDetteFiscale'];

if (($valImmo == 0 ) || ($valImmo == null)){
    echo 0;
} else if ($valImmo <= ($dette/4) ) {// 0---> 25%
    echo 1 * $critere['coefficient'];
} else if (($valImmo > ($dette/4)) && ($valImmo <= ($dette/2) )) { // 25--->50%
    echo 2 * $critere['coefficient'];
} else if ($valImmo == $dette){
    echo 4 * $critere['coefficient'];
} else {
    echo 3 * $critere['coefficient'];
}

/* Existence de débiteurs (créances)
Si Absence de créances mobilisables score=0
Sinon si créances==25%*dette fiscale score=1
Sinon si créances==50%*dette fiscale score=2
Sinon créances mobilisables et incorporelles =dette fiscale score =3 */
