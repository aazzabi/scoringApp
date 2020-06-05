<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");

require_once('connect.php ');
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$postdata = file_get_contents("php://input");

if (isset($postdata) && !empty($postdata)) {
    // Extraire the data.
    $request = json_decode($postdata);

    $pwd = $request->data->pwd;
    $email = $request->data->email;


    $sql = "SELECT * FROM employee where email='$email' and pwd='$pwd'";


    $res = $pdo->query($sql);
    $row = $res->fetch();
    if ($row)
        echo '{"email":"' . $row[3] . '","pwd":"' . $row[2] . '"}';
    else
        http_response_code(404);

}
?>
