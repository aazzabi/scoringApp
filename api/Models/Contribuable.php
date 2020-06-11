<?php

class Contribuable
{

    // database connection and table name
    private $conn;
    private $table_name = "contribuable";

    // object properties
    public $id;
    public $libelle;
    public $activite;
    public $formeJuridique;

    // constructor
    public function __construct($db)
    {
        $this->conn = $db;
    }

    function create()
    {
        // insert query
        $query = "INSERT INTO contribuable(`libelle`, `activite`, `formeJuridique`) VALUES  (:libelle, :activite, :formeJuridique )";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->libelle = htmlspecialchars(strip_tags($this->libelle));
        $this->activite = htmlspecialchars(strip_tags($this->activite));
        $this->formeJuridique = htmlspecialchars(strip_tags($this->formeJuridique));

        // bind the values
        $stmt->bindParam(':formeJuridique', $this->formeJuridique);
        $stmt->bindParam(':libelle', $this->libelle);
        $stmt->bindParam(':activite', $this->activite);

        // execute the query, also check if query was successful
        if ($stmt->execute()) {
            return  json_encode(array('message' => 'Le contribuable a été crée avec succés'));
        }
        return json_encode("{message:Un probléme a survenu lors de la création}");
    }

    public function getAll()
    {
        $query = "SELECT * FROM contribuable";

        $stmt = $this->conn->query($query);
        $stmt->execute();

        $m = '[';
        foreach ($stmt as $row) {
            $m = $m . '{"id":"' . $row['id'] . '"
            ,"libelle":"' . $row['libelle'] . '"
            ,"formeJuridique":"' . $row['formeJuridique'] . '"
            ,"activite":"' . $row['activite'] . '"},';
        }
        $m = substr($m, 0, strlen($m) - 1);
        $m = $m . ']';
        echo $m;
    }

    public function getById($i)
    {
        $query = "SELECT * FROM contribuable where  id=:id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $i);

        $stmt->execute();
        $row = $stmt->fetch();
        echo '{"id":"' . $row[0] . '"
             ,"libelle":"' . $row[1] . '"
             ,"formeJuridique":"' . $row[2] . '"
             ,"activite":"' . $row[3] . '"
        },';
    }

    public function delete($i)
    {
        $query = "DELETE FROM contribuable where  id=:id";
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

    public function update($c)
    {
        $req = "UPDATE contribuable 
    SET libelle='$c->libelle',activite='$c->activite',formeJuridique='$c->formeJuridique'  WHERE id='$c->id'";
        $res = $this->conn->exec($req);
        echo $res;
        if ($res) {
            http_response_code(200);
            echo json_encode(array('message' => 'Ce contribuable a été mis a jour avec succés'));
        } else {
            return http_response_code(422);
            echo json_encode("{message:Un probléme a survenu lors de la modification, veuillez réessayer ulteriérement}");
        }
    }
}
