<?php

class Creance
{
    // database connection and table name
    private $conn;
    private $table_name = "creance";

    // object properties
    public $id;
    public $recette;
    public $secteurActivite;
    public $immatriculation;
    public $score;

    public $dateFin;
    public $dernierAct;
    public $dernierPaiement;
    public $dateDebut;

    public $contribuable;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
//        $query = "SELECT c.* , ctr.libelle as libelleContribuable, ctr.id as idCtr
//                  FROM creance as c , contribuable  as ctr
//                  where c.contribuable_id = ctr.id";
        $query = "select * from creance";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public function getAllCreance()
    {

        $query = "SELECT c.* , ctr.libelle as libelleContribuable, ctr.id as idCtr  FROM creance as c , contribuable  as ctr where c.contribuable_id = ctr.id";
//        $query = "SELECT c.*  FROM `creance`as c";
        $stmt = $this->conn->query($query);
        $m = '[';
        foreach ($stmt as $row) {
            $m = $m . '{"id":"' . $row['id'] . '"
                ,"recette":"' . $row['recette'] . '"
                ,"secteurActivite":"' . $row['secteurActivite'] . '"
                ,"libelleContribuable":"' . $row['libelleContribuable'] . '"
                ,"idCtr":"' . $row['idCtr'] . '"
                ,"dateFin":"' . $row['dateFin'] . '"
                ,"dateDebutPriseEnCharge":"' . $row['dateDebutPriseEnCharge'] . '"
                ,"dernierAct":"' . $row['dernierAct'] . '"
                ,"immatriculation":"' . $row['immatriculation'] . '"
                ,"score":"' . $row['score'] . '"
                ,"montant":"' . $row['montant'] . '"
                ,"statut":"' . $row['statut'] . '"
                ,"type":"' . $row['type'] . '"
                ,"origine":"' . $row['origine'] . '"
                ,"dernierPaiement":"' . $row['dernierPaiement'] . '"},';
        }
        $m = substr($m, 0, strlen($m) - 1);
        $m = $m . ']';
        echo $m;
    }

    public function getById($i)
    {
        $query = "SELECT c.* , ctr.libelle as libelleContribuable, ctr.id as idCtr 
                  FROM creance as c , contribuable  as ctr 
                  where c.contribuable_id = ctr.id and
                   c.id =:id  ";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $i);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

//    function create()
//    {
//        // insert query
//        $query = "INSERT INTO choix (libelle, note, coefficient, pondere, critere_id)
//              values (:libelle,:note,:coefficient, :pondere, :critere)";
//
//        // prepare the query
//        $stmt = $this->conn->prepare($query);
//
//        // sanitize
//        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
//        $this->note = htmlspecialchars(strip_tags($this->note));
//        $this->coefficient = htmlspecialchars(strip_tags($this->coefficient));
//        $this->critere = htmlspecialchars(strip_tags($this->critere));
//        $this->pondere = htmlspecialchars(strip_tags($this->pondere));
//
//        // bind the values
//        $stmt->bindParam(':coefficient', $this->coefficient);
//        $stmt->bindParam(':libelle', $this->libelle);
//        $stmt->bindParam(':note', $this->note);
//        $stmt->bindParam(':pondere', $this->pondere);
//        $stmt->bindParam(':critere', $this->critere);
//
//        // execute the query, also check if query was successful
//        if ($stmt->execute()) {
//            return json_encode(array('message' => 'Le choix a été crée avec succés', 'status' => 200));
//        }
//        return json_encode(array('message' => 'Un probléme a survenu lors de la création', 'status' => 400));
//    }

//    public function update($c)
//    {
//        $req = "UPDATE choix
//              SET libelle='$c->libelle',
//              critere_id='$c->critere',
//              note='$c->note' ,
//              pondere='$c->pondere' ,
//              coefficient='$c->coefficient'  WHERE id='$c->id'";
//        echo $req;
//        $res = $this->conn->exec($req);
//        echo $res;
//        if ($res) {
//            http_response_code(200);
//            echo json_encode(array('message' => 'Ce choix a été mis a jour avec succés', 'status' => 200));
//        } else {
//            return http_response_code(422);
//            echo json_encode("{message:Un probléme a survenu lors de la modification, veuillez réessayer ulteriérement}");
//        }
//    }

//    public function delete($i)
//    {
//        $query = "DELETE FROM choix where  id=:id";
//        try {
//            $stmt = $this->conn->prepare($query);
//            $stmt->bindParam(':id', $i);
//            $stmt->execute();
//            $stmt->fetch();
//            return $stmt->fetch();
//        } catch (\PDOException $e) {
//            exit($e->getMessage());
//        }
//    }


}