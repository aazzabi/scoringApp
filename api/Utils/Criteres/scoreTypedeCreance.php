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


$type = $creance['type'];

$search  = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ');
$replace = array('A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y');
$o = str_replace($search, $replace, utf8_encode(strtolower($type)));

if ($o == 'impot annuels') {
    echo 0;
} elseif ($o == 'impot mensuels hors retenue a la source') {
    echo 1 * $critere['coefficient'];
} elseif ($o == 'retenues a la source et tva') {
    echo 2 * $critere['coefficient'];
} elseif ($o == 'amendes et condamnations pecuniaires') {
    echo 3 * $critere['coefficient'];
} elseif ($o == 'droits d\'enregistrement et redevances domaniales') {
    echo 3 * $critere['coefficient'];
}

/* 
si Type de créance== "Impôts annuels" score= 0 
sinon si Type de créance== "Impôts mensuels hors retenue à la source" score= 1
sinon si Type de créance== "Retenues à la source et TVA" score= 2
sinon si si Type de créance== "Amendes et condamnations pécuniaires" score= 3
sinon si Type de créance== "Droits d'enregistrement et redevances domaniales"  score= 4
*/ 