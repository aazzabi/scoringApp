<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();
require_once '../Models/Critere.php';


$critere = new Critere($pdo);
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $request = json_decode($postdata);

    $critere->libelle = $request->libelle;
    $critere->isActive = $request->isActive;
    $critere->critereFilename = $request->critereFilename;
    $critere->coefficient = $request->coefficient;
    $critere->createdBy = $request->createdBy;


    echo $critere->create();
}
