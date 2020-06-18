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

$montant = $contribuable['creditOuExcedentTVA'];

/* Existence de débiteurs (créances)
Si Absence de créances mobilisables score=0
Sinon si créances==25%*dette fiscale score=1
Sinon si créances==50%*dette fiscale score=2
Sinon créances mobilisables et incorporelles =dette fiscale score =3 */
