<?php
/**
 * Created by PhpStorm.
 * User: arafe
 * Date: 11/06/2020
 * Time: 12:34
 */
include_once 'Critere.php';

class Choix
{
    // database connection and table name
    private $conn;
    private $table_name = "critere";

    // object properties
    public $id;
    public $libelle;
    public $note;
    public $coefficient;
    public $pondere;
    public $critere;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }


    public function getAll()
    {
        $query = "SELECT c.* , cr.libelle as libelleCr, cr.id as idCr 
                  FROM choix as c , critere as cr 
                  where c.critere_id = cr.id";

        $stmt = $this->conn->query($query);
        $stmt->execute();

        $m = '[';
        foreach ($stmt as $row) {
            $m = $m . '{"id":"' . $row['id'] . '"
            ,"libelle":"' . $row['libelle'] . '"
            ,"note":"' . $row['note'] . '"
            ,"critereId":"' . $row['idCr'] . '"
            ,"critere":"' . $row['libelleCr'] . '"
            ,"coefficient":"' . $row['coefficient'] . '"
            ,"pondere":"' . $row['pondere'] . '"},';
        }
        $m = substr($m, 0, strlen($m) - 1);
        $m = $m . ']';
        echo $m;
    }

    public function getAllByCritere($i)
    {
        $query = "SELECT c.* , cr.libelle as libelleCr, cr.id as idCr 
                  FROM choix as c , critere as cr 
                  WHERE c.critere_id = cr.id AND c.critere_id=".$i;
        try {
            $stmt = $this->conn->query($query);
            $stmt->execute();
            if ($stmt->rowCount() ==0 ){
                echo '[';
            }
            $m = '[';
            foreach ($stmt as $row) {
                $m = $m . '{"id":"' . $row['id'] . '"
                ,"libelle":"' . $row['libelle'] . '"
                ,"libelleCr":"' . $row['libelleCr'] . '"
                ,"idCr":"' . $row['idCr'] . '"
                ,"note":"' . $row['note'] . '"
                ,"critereId":"' . $row['idCr'] . '"
                ,"critere":"' . $row['libelleCr'] . '"
                ,"coefficient":"' . $row['coefficient'] . '"
                ,"pondere":"' . $row['pondere'] . '"},';
            }
            $m = substr($m, 0, strlen($m) - 1);
            $m = $m . ']';
            echo $m;
        } catch (\PDOException $e) {
            echo ($e->getMessage());
        }
    }

    public function getById($i)
    {
        $query = "SELECT c.* , cr.libelle as libelleCr, cr.id as idCr
                  FROM choix as c , critere as cr 
                  where c.id=:id and
                   c.critere_id = cr.id  ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $i);

        $stmt->execute();
        $row = $stmt->fetch();
        echo $row['idCr'];
        echo '{"id":"' . $row['id'] . '"
            ,"libelle":"' . $row['libelle'] . '"
            ,"critereId":"' . $row['idCr'] . '"
            ,"note":"' . $row['note'] . '"
            ,"critere":"' . $row['libelleCr'] . '"
            ,"coefficient":"' . $row['coefficient'] . '"
            ,"pondere":"' . $row['pondere'] . '"},';
    }

    function create()
    {
        // insert query
        $query = "INSERT INTO choix (libelle, note, coefficient, pondere, critere_id) 
              values (:libelle,:note,:coefficient, :pondere, :critere)";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
        $this->note = htmlspecialchars(strip_tags($this->note));
        $this->coefficient = htmlspecialchars(strip_tags($this->coefficient));
        $this->critere = htmlspecialchars(strip_tags($this->critere));
        $this->pondere = htmlspecialchars(strip_tags($this->pondere));

        // bind the values
        $stmt->bindParam(':coefficient', $this->coefficient);
        $stmt->bindParam(':libelle', $this->libelle);
        $stmt->bindParam(':note', $this->note);
        $stmt->bindParam(':pondere', $this->pondere);
        $stmt->bindParam(':critere', $this->critere);

        // execute the query, also check if query was successful
        if ($stmt->execute()) {
            return json_encode(array('message' => 'Le choix a été crée avec succés', 'status' => 200));
        }
        return json_encode(array('message' => 'Un probléme a survenu lors de la création', 'status' => 400));
    }

    public function update($c)
    {
        $req = "UPDATE choix 
              SET libelle='$c->libelle', 
              critere_id='$c->critere',
              note='$c->note' ,
              pondere='$c->pondere' ,
              coefficient='$c->coefficient'  WHERE id='$c->id'";
        echo $req;
        $res = $this->conn->exec($req);
        echo $res;
        if ($res) {
            http_response_code(200);
            echo json_encode(array('message' => 'Ce choix a été mis a jour avec succés', 'status' => 200));
        } else {
            return http_response_code(422);
            echo json_encode("{message:Un probléme a survenu lors de la modification, veuillez réessayer ulteriérement}");
        }
    }

    public function delete($i)
    {
        $query = "DELETE FROM choix where  id=:id";
        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $i);
            $stmt->execute();
            $stmt->fetch();
            return $stmt->fetch();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }


}