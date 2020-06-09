<?php
// 'user' object
class User{

    // database connection and table name
    private $conn;
    private $table_name = "user";

    // object properties
    public $id;
    public $nom;
    public $prenom;
    public $email;
    public $username;
    public $role;
    public $password;

    // constructor
    public function __construct($db){
        $this->conn = $db;
    }

    // create new user record
    function create(){
        // insert query
        $query = "INSERT INTO user
                SET
                    prenom = :prenom,
                    nom = :nom,
                    username = :username,
                    role = :role,
                    email = :email,
                    password = :password";

        // prepare the query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->role=htmlspecialchars(strip_tags($this->role));
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));

        // bind the values
        $stmt->bindParam(':role', $this->role);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':email', $this->email);

        // hash the password before saving to database
        $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password_hash);

        // execute the query, also check if query was successful
        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // check if given email exist in the database
    function emailExists() {

        // query to check if email exists
        $query = "SELECT *
                FROM user
                WHERE email = ?
                LIMIT 0,1";

        // prepare the query
        $stmt = $this->conn->prepare( $query );

        // sanitize
        $this->email= htmlspecialchars(strip_tags($this->email));

        // bind given email value
        $stmt->bindParam(1, $this->email);

        // execute the query
        $stmt->execute();

        // get number of rows
        $num = $stmt->rowCount();

        // if email exists, assign values to object properties for easy access and use for php sessions
        if($num>0){

            // get record details / values
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            // assign values to object properties
            $this->id = $row['id'];
            $this->nom = $row['nom'];
            $this->prenom = $row['prenom'];
            $this->role = $row['role'];
            $this->username = $row['username'];
            $this->password = $row['password'];
            // return true because email exists in the database
            return true;
        }
        // return false if email does not exist in the database
        return false;
    }

// create() method will be here
}
