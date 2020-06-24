<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require_once getcwd().'../../Models/Creance.php';
require_once getcwd().'../../Models/Contribuable.php';
require_once getcwd().'../../connect.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$creanCtrl = new Creance($pdo);
$contribCtrl = new Contribuable($pdo);

$id = $_GET['id'];
$creance = $creanCtrl->getById($id);
$contribuable = $contribCtrl->getById($creance['idCtr']);

$montant = $contribuable['creditOuExcedentTVA'];
$dette = $contribuable['montantDetteFiscale'];

if ($montant == 0) {
    echo 0;
} else if ($montant < ($dette / 4 )){ //0---> 50%
    echo 1;
} else if (($montant >= ($dette / 4 )) && ($montant < ($dette / 2 ))) { //25--->50%
    echo 2;
} else if ($montant == $dette) {
    echo 4;
} else {
    echo 3;
}

/* Existence d’un crédit de TVA ou d'un excédent de versement d’acomptes provisionnels
Si Crédit ou excèdent de TVA == null score=0
Sinon si Crédit ou excèdent de TVA==25%*dette fiscale score=1
Sinon si Crédit ou excèdent de TVA==50%*dette fiscale score=2
Sinon Crédit ou excèdent de TVA==dette fiscale score=3 */
