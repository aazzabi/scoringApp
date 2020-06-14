<?php
/**
 * Created by PhpStorm.
 * User: arafe
 * Date: 11/06/2020
 * Time: 10:33
 */

class Critere
{
    // database connection and table name
    private $conn;
    private $table_name = "critere";

    // object properties
    public $id;
    public $libelle;
    public $isActive;
    public $critereFilename;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create new critere record
    function create()
    {
        // insert query
        $query = "INSERT INTO critere (libelle, isActive, critereFilename) values (:libelle,:isActive,:critereFilename)";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
        $this->isActive = htmlspecialchars(strip_tags($this->isActive));
        $this->critereFilename = htmlspecialchars(strip_tags($this->critereFilename));

        // bind the values
        $stmt->bindParam(':critereFilename', $this->critereFilename);
        $stmt->bindParam(':libelle', $this->libelle);
        $stmt->bindParam(':isActive', $this->isActive);

        // execute the query, also check if query was successful
        if ($stmt->execute()) {
           $last_id = (int) $this->conn->lastInsertId();
           return json_encode(array('message' => 'Le critere a été crée avec succés', 'status' => 200, 'lastInsertId' => $last_id));
        }
        return json_encode(array('message' => 'Un probléme a survenu lors de la création du critére', 'status' => 400));
    }

    public function getById($i)
    {
        $query = "SELECT * FROM critere where id=:i";

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':i', $i);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getAll()
    {
        //SELECT c.* , (SELECT count(*) from choix cx where cx.critere_id = c.id) as counting FROM `critere`as c
//        $query = "SELECT * FROM critere";
        $query = "SELECT c.* , (SELECT count(*) from choix cx where cx.critere_id = c.id) as nbrChoix FROM `critere`as c";
        try {
            $stmt = $this->conn->query($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function update($c)
    {
        $req = "UPDATE critere
              SET libelle='$c->libelle',isActive='$c->isActive',critereFilename='$c->critereFilename'  
              WHERE id='$c->id'";
        $res = $this->conn->exec($req);
        echo $res;
        if ($res) {
            http_response_code(200);
            echo json_encode(array('message' => 'Ce critére a été mis a jour avec succés', 'status' => 200));
        } else {
            return http_response_code(400);
            echo json_encode("{message:Un probléme a survenu lors de la modification, veuillez réessayer ulteriérement}");
        }
    }

    public function delete($i)
    {
        $query = "DELETE FROM critere where  id=:id";
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

    public function activate($i)
    {
        $query = "UPDATE critere SET isActive= true where  id=:id";
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

    public function desactivate($i)
    {
        $query = "UPDATE critere SET isActive= false where  id=:id";
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
