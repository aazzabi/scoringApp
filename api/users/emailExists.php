<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');
include_once '../Models/User.php';

require_once('../connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

// file_get_contents — Lit tout un fichier dans une chaîne
// php:input est un flux en lecture seule qui permet de lire des données brutes depuis le corps de la requête.
// Dans le cas de requêtes POST, il est préférable d'utiliser le flux php:input
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $request = json_decode($postdata);
    $user = new User($pdo);

    $user->email = $request->email;
    $email_exists = $user->emailExists();

    echo $email_exists;
    if ( $email_exists) {
        http_response_code(400);
        echo json_encode(array('status'=> 400, 'message' => 'Email existant'));
    } else {
        http_response_code(200);
        echo json_encode(array('status'=> 200, 'message' => 'Nouveau email'));
    }
}