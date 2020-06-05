<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");

require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

// file_get_contents — Lit tout un fichier dans une chaîne
// php:input est un flux en lecture seule qui permet de lire des données brutes depuis le corps de la requête.
// Dans le cas de requêtes POST, il est préférable d'utiliser le flux php:input
$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $request = json_decode($postdata);

    $nom = $request->data->nom;
    $activite = $request->data->activite;
    $formejur = $request->data->formejur;
    $score = $request->data->score;
    // enregistrement dans la BD.
    $req = "INSERT INTO entreprises VALUES (NULL,'$nom','$activite','$formejur','$score')";
    $res = $pdo->exec($req);
    $entreprise = [
        'nom' => $nom,
        'activite' => $activite,
        'formejur' => $formejur,
        'score' => $score,
        'id' => $pdo->lastInsertId()
    ];
    //renvoyer les données pour l'affichage
    echo json_encode(['data' => $entreprise]);
}
