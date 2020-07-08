<?php

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/text');

require '../connect.php ' ;
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];

$req = "SELECT c.id, c.libelle , c.isActive , c.critereFilename FROM `critere`as c where  c.isActive = true ";
$res = $pdo->query($req);
if ($res->rowCount() > 0) {
    $m = '[';
    foreach ($res as $row) {
        $m = $m . '{"id":"' . $row[0] . '"
    ,"libelle":"' . $row['libelle'] . '"
    ,"isActive":"' . $row['isActive'] . '"
    ,"critereFilename":"' . $row['critereFilename']
            . '"},';
    }
    $m = substr($m, 0, strlen($m) - 1);
    $m = $m . ']';

    $scoreEtat = 0;
    try {
        foreach (json_decode($m, true) as $row) {
//        echo $row['critereFilename'] .'-';
            $v = executeScoreFile(getcwd() . '\\Criteres\\' . $row['critereFilename'] . '.php', $row['id']);
            $scoreEtat += $v;
        }
        echo $scoreEtat;
    } catch (Exception $e) {
        echo $e;
    }
} else {
    echo 0;
}
function executeScoreFile($filename, $v){
    ob_start();
    $_GET['idCritere'] = $v;
    include $filename;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
?>
