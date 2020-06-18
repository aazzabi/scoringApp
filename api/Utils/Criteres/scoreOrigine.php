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

$origine = $creance['origine'];



$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
$o = str_replace($search, $replace, utf8_encode(strtolower($origine)));

if ($o == 'dgi : taxation d\'office des defaillants declaratifs') {
    echo 0;
} elseif ($o == 'dgi : verification generale') {
    echo 1;
} elseif ($o == 'dgi : verification preliminaire') {
    echo 2;
} elseif ($o == 'creance non fiscale') {
    echo 3;
} elseif ($o == 'dgi : verification ponctuelle') {
    echo 3;
} elseif ($o == 'dgi : declaration sans paiement') {
    echo 4;
}



/* Origine
Si Origine de la créance==’’ DGI : Taxation d'office des défaillants déclaratifs’’ score=0
Sinon si Origine de la créance==’’ DGI :  Vérification Générale’’ score=1
Sinon si Origine de la créance==’’ DGI : Vérification préliminaire’’ score=2
Sinon si Origine de la créance==’’ Créance non fiscale’’ score=3
Sinon si  Origine de la créance==’’ DGI : vérification ponctuelle’’ score=3
Sinon Origine de la creance==’’ DGI : déclaration sans paiement’’ score=4 */
