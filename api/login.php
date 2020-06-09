<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding, X-Auth-Token");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Content-type: application/json');
include_once 'Models/User.php';

include_once 'config/core.php';
include_once 'libs/php-jwt-master/src/BeforeValidException.php';
include_once 'libs/php-jwt-master/src/ExpiredException.php';
include_once 'libs/php-jwt-master/src/SignatureInvalidException.php';
include_once 'libs/php-jwt-master/src/JWT.php';
use \Firebase\JWT\JWT;

require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $user = new User($pdo);
    $data = json_decode(file_get_contents("php://input"));

    // set product property values
    $user->email = $data->email;
    $email_exists = $user->emailExists();

    if($email_exists && password_verify($data->password, $user->password)){
        $token = array(
           "iss" => $iss,
           "aud" => $aud,
           "iat" => $iat,
           "nbf" => $nbf,
           "data" => array(
               "id" => $user->id,
               "nom" => $user->nom,
               "prenom" => $user->prenom,
               "username" => $user->username,
               "role" => $user->role,
               "email" => $user->email
           )
        );
        http_response_code(200);
        // generate jwt
        $jwt = JWT::encode($token, $key);
        echo json_encode(
                array(
                    "message" => "Successful login.",
                    "token" => $jwt,
                    "status" => 200,
                )
            );
    }  else{
         http_response_code(401);
         echo json_encode(array("message" => "Veuillez vérifier vos données."));
    }
/*

    $request = json_decode($postdata);
    $password = $request->password;
    $email = $request->email;

    $email_exists = emailExists($email);

    $sql = "SELECT * FROM user where email='$email' and password='$password'";
    try {
        $res = $pdo->query($sql);
        $row = $res->fetch();
        if ($row)
            echo '{"id":"' . $row[0] . '" ,"nom":"' . $row[1] . '" ,"prenom":"' . $row[2] . '" ,"email":"' . $row[3] . '","username":"' . $row[4] . '" ,"role":"' . $row[5] . '"},';
        else http_response_code(404);
    } catch (Exception $e) {
        echo $e->getMessage();
    }
    */
}
?>
