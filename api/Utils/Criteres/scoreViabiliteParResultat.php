<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd() . '../../Models/Creance.php';
require_once getcwd() . '../../Models/Contribuable.php';
require_once getcwd() . '../../Models/Critere.php';
require_once getcwd() . '../../connect.php ';

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


$montantResultatComptable1 = $contribuable['montantResultatComptable1'];
$montantResultatComptable2 = $contribuable['montantResultatComptable2'];
$montantResultatComptable3 = $contribuable['montantResultatComptable3'];
$totalResultat = $montantResultatComptable3 + $montantResultatComptable2 + $montantResultatComptable1;
$moyeResultat = ($totalResultat) / 3;


$montantRevenuGlobalDeclare1 = $contribuable['montantRevenuGlobalDeclare1'];
$montantRevenuGlobalDeclare2 = $contribuable['montantRevenuGlobalDeclare2'];
$montantRevenuGlobalDeclare3 = $contribuable['montantRevenuGlobalDeclare3'];
$totalRevenu = $montantRevenuGlobalDeclare3 + $montantRevenuGlobalDeclare2 + $montantRevenuGlobalDeclare1;
$moyeRevenu = ($totalRevenu) / 3;

$dette = $contribuable['montantDetteFiscale'];
if ($moyeRevenu > $dette) { // +4 dans tout les cas
    if ($moyeResultat <= 0) {
        echo 4 * $critere['coefficient']; //0 +4
    } else if (($moyeResultat > 0) && ($moyeResultat < ($dette / 3))) {
        echo 5; //1 +4
    } else if (($moyeResultat >= ($dette / 3)) && ($moyeResultat < $dette)) {
        echo 6; //2 +4
    } else if ($moyeResultat >= $dette) {
        echo 7; //3 +4
    }
} else { // dette > moyRevenu
    if ($moyeResultat <= 0) {
        echo 0;
    } else if (($moyeResultat > 0) && ($moyeResultat < ($dette / 3))) {
        echo 1 * $critere['coefficient'];
    } else if (($moyeResultat > ($dette / 3)) && ($moyeResultat < $dette)) {
        echo 2 * $critere['coefficient'];
    } else if ($moyeResultat >= $dette) {
        echo 3 * $critere['coefficient'];
    }
}

/* si Moyenne du résultat comptable déclaré au titre des 3 dernières années ≤ à 0
Moyenne du résultat comptable= (Montant resultat comptable n-3 + Montant resultat comptable n-2 + Montant resultat comptable n-1)/3
si Moyenne du résultat comptable <0 score= 0 
sinon si Moyenne du résultat comptable >0 score=1 
sinon si Moyenne du résultat comptable> 1/3 de la dette fiscale score= 2
sinon si Moyenne du résultat comptable> la dette fiscale score= 3
sinon si Montant du (revenu global déclaré n-3 + Montant du revenu global déclaré n-2 + Montant du revenu global déclaré n-1) / 3 >= dette fiscale score= 4 */
