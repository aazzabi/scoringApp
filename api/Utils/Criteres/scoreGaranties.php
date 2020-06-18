<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Authorization, Accept, Client-Security-Token, Accept-Encoding");
//header('Content-type: application/json');
require '../../Models/Creance.php';
require '../../Models/Contribuable.php';
require '../../connect.php ';
$cnx = new connexion();
$pdo = $cnx->CNXbase();
$creanCtrl = new Creance($pdo);
$contribCtrl = new Contribuable($pdo);

$id = $_GET['id'];
$creance = $creanCtrl->getById($id);
$contribuable = $contribCtrl->getById($creance['idCtr']);

$cautionBancaire = $contribuable['cautionBancaire'];
$autresGaranties = $contribuable['autresGaranties'];



/* Garanties
Si Aucune garantie == null score=0
Sinon si Garantie  !=null ou caution bancaire !=null score=1
Sinon si Existence d'un privilège sur immeuble score=2
Sinon Existence d'une caution bancaire score=3 */
