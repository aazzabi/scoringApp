<?php

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
header('Content-type: application/text');

require_once '../connect.php ' ;
$cnx = new connexion();
$pdo = $cnx->CNXbase();

$id = $_GET['id'];

$req = "SELECT c.id, c.libelle , c.isActive , c.critereFilename FROM `critere`as c where  c.isActive = true ";
$res = $pdo->query($req);
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
        $v = executeScoreFile(getcwd().'\\Criteres\\'.$row['critereFilename'] . '.php');
        $scoreEtat += $v;
    }
    echo $scoreEtat;
} catch (Exception $e) {
    echo $e;
}

function executeScoreFile($filename){
    ob_start();
    include $filename;
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
}
?>
