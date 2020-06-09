<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/json');

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

    $id = $request->id;
    $libelle = $request->libelle;
    $activite = $request->activite;
    $formeJuridique = $request->formeJuridique;
    $req = "UPDATE contribuable SET libelle='$libelle',activite='$activite',formeJuridique='$formeJuridique'  WHERE id='$id'";
    $res = $pdo->exec($req);
    echo $res;
    if ($res) {
        http_response_code(200);
        echo  json_encode(array('message' => 'Ce contribuable a été mis a jour avec succés'));
    } else {
        return http_response_code(422);
         echo json_encode("{message:Un probléme a survenu lors de la modification, veuillez réessayer ulteriérement}");
    }
}
