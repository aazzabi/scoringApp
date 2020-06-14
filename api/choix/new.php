<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
require_once '../Models/Choix.php';


$choix = new Choix($pdo);
// file_get_contents — Lit tout un fichier dans une chaîne
// php:input est un flux en lecture seule qui permet de lire des données brutes depuis le corps de la requête.
// Dans le cas de requêtes POST, il est préférable d'utiliser le flux php:input
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $request = json_decode($postdata);

    $choix->libelle = $request->libelle;
    $choix->note = $request->note;
    $choix->pondere = $request->pondere;
    $choix->coefficient = $request->coefficient;
    $choix->critere = $request->critere;
    echo $choix->create();
}
