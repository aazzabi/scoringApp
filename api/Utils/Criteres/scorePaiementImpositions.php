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

$nbEchNonRepect = $contribuable['nbrEcheancePlanReglementNonRespectee'];
$nbPaiementCheqSansProvi = $contribuable['nbrPaiementParChequeSansProvision'];

$paiementEffectuesAuPlusTardDateExigibilite = $contribuable['paiementEffectuesAuPlusTardDateExigibilite'];

if ($nbEchNonRepect > 1 ) {
    echo 0;
} else if ($nbPaiementCheqSansProvi > 1 ) {
    echo 0;
} else if ($paiementEffectuesAuPlusTardDateExigibilite < 50 ) {
    echo 0;
} else if (($paiementEffectuesAuPlusTardDateExigibilite > 50)
    && ($paiementEffectuesAuPlusTardDateExigibilite<= 75 )) {
    echo 1;
} else if (($paiementEffectuesAuPlusTardDateExigibilite > 75)
    && ($paiementEffectuesAuPlusTardDateExigibilite<=90)) {
    echo 2;
} else if ($paiementEffectuesAuPlusTardDateExigibilite > 90){
    echo 3;
}

//paiement des impositions
/*si Nombre d'échéances d'un plan de règlement non respectée >1 score=0 
*sinon si Nombre de paiements par chèque sans provision>1 score=0 
*sinon si Paiements effectués au plus tard à la date d'exigibilité>50% score=0
*sinon si 50%<Paiements effectués au plus tard à la date d'exigibilité<75% score=1 
*sinon si 75%<Paiements effectués au plus tard à la date d'exigibilité<90% score=2
*sinon (Paiements effectués au plus tard à la date d'exigibilité> 90%) score=3 */