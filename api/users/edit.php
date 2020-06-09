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
    $nom = $request->nom;
    $prenom = $request->prenom;
    $email = $request->email;
    $role = $request->role;
    $username = $request->username;
    if($request->password)  {
        $password = password_hash($request->password, PASSWORD_BCRYPT) ;
        $req = "UPDATE user SET nom='$nom',prenom='$prenom',email='$email' , role='$role', password='$password' ,username='$username'  WHERE id='$id'";
    } else {
        $req = "UPDATE user SET nom='$nom',prenom='$prenom',email='$email' ,role='$role' ,username='$username'  WHERE id='$id'";
    }
    $res = $pdo->exec($req);
    if ($res) {
        http_response_code(204);
    } else {
        return http_response_code(422);
    }
}
